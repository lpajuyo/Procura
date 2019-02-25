<?php

namespace App\Http\Controllers;

use App\CommonUseItem;
use Illuminate\Http\Request;
use App\ItemType;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cseItems = CommonUseItem::all();

        $itemTypes = ItemType::all();

        return view('cse_index', compact('cseItems', 'itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemTypes = ItemType::all();

        return view('create_cse_item', compact('itemTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_type_id' => 'required|exists:item_types,id',
            'code' => 'required|unique:common_use_items',
            'description' => 'required',
            'uom' => 'required',
            'price' => 'required|numeric|min:1'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'create')->withInput();
        }

        CommonUseItem::create($validator->valid());

        return back();
    }

    public function storeByFile(Request $request)
    {
        // dd($request->file('catalog_file'));
        //validation
        $validated = $request->validate([
            //'item_type_id' => 'required|exists:item_types,id',
            'catalog_file' => 'required|mimes:xlsx,xls,xml,csv,html'
        ]);

        libxml_use_internal_errors(true);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($request->file('catalog_file'));
        $reader->setReadDataOnly(false);
        $spreadsheet = $reader->load($request->file('catalog_file'));
        $worksheet = $spreadsheet->getActiveSheet();
        
        //get 'description' table headers coordinates
        for($row = 1; $row <= $worksheet->getHighestRow(); ++$row){
            for($col = 'A'; $col != $worksheet->getHighestColumn(); ++$col){
                if(Str::contains($worksheet->getCell($col.$row)->getValue(), ['Description', 'description'])){
                    $prodDescCoord[] = ['col' => $col, 'row' => $row];
                }
            }
        }
        
        $prodDescCoord = Collection::wrap($prodDescCoord);
        for($i = 0; $i < $prodDescCoord->count(); $i++){
            if(isset($prodDescCoord[$i+1])){
                $startRange = chr(ord($prodDescCoord[$i]['col']) - 1) . ($prodDescCoord[$i]['row'] + 1);
                $endRange = $worksheet->getHighestColumn() . ($prodDescCoord[$i+1]['row'] - 1);
            }
            else{
                $startRange = chr(ord($prodDescCoord[$i]['col']) - 1) . ($prodDescCoord[$i]['row'] + 1);
                $endRange = $worksheet->getHighestColumn() . $worksheet->getHighestRow();
            }

            $range = $startRange . ':' . $endRange;
            $dataArray = $worksheet->rangeToArray($range);

            foreach($dataArray as $data){
                if($data[0] != null){
                    CommonUseItem::updateOrCreate([
                        "code" => $data[0],
                    ],
                    [
                        "description" => $data[1],
                        "uom" => $data[2],
                        // "item_type_id" => $request->item_type_id,
                        "price" => (is_string($data[3])) ? (float)str_replace(",", "", $data[3]): $data[3]
                    ]);
                }
            }
        }

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        return redirect()->route('cse_items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommonUseItem  $cseItem
     * @return \Illuminate\Http\Response
     */
    public function show(CommonUseItem $cseItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommonUseItem  $cseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CommonUseItem $cseItem)
    {
        return $cseItem->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommonUseItem  $cseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommonUseItem $cseItem)
    {
        $validator = Validator::make($request->all(), [
            'item_type_id' => 'required|exists:item_types,id',
            'code' => ['required', Rule::unique('common_use_items')->ignore($cseItem->id)],
            'description' => 'required',
            'uom' => 'required',
            'price' => 'required|numeric|min:1'
        ]);

        if($validator->fails()){
            return back()
                            ->withErrors($validator, 'edit')
                            ->withInput()
                            ->with('id', $cseItem->id);
        }

        $cseItem->update($validator->valid());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommonUseItem  $cseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommonUseItem $cseItem)
    {
        $cseItem->delete();

        return back();
    }
}
