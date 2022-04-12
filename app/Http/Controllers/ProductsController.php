<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Validation\Validator as ValidationValidator;

class ProductsController extends Controller
{
    //
    public function store (Request $request){

        //melakukan validasi inputan
        $validator = Validator::make($request ->all(),[
            'product_name' => 'required|max:50',
            'product_type' => 'required|in:snack,drink,makeup,drugs',
            'product_price' =>'required|numeric',
            'expired_date' => 'required|date'
        ]);

        //kondisi inputan salah

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        //inputan yang sudah benar
        $validated = $validator ->validated();

        //input ke tabel product
        product::create([
            'product_name' =>$validated['product_name'],
            'product_type' =>$validated['product_type'],
            'product_price'=>$validated['product_price'],
            'expired_date' =>$validated['expired_date']
        ]);

        return response()->json('product berhasil disimpan')->setStatusCode(201);
      }

        //tampil data
        public function show(){
        $Products = Product::all();

        return response()->json($Products)->setStatusCode(200);
        }

        public function update (Request $request,$id){
            //melakukan validasi inputan
            $validator = Validator::make($request->all(),[
            'product_name' => 'required|max:50',
            'product_type' => 'required|in:snack,drink,makeup,drugs',
            'product_price' =>'required|numeric',
            'expired_date' => 'required|date'
        ]);

            //kondisi inputan salah

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }
            //inputan yang sudah benar
        $validated = $validator->validated();

        $checkdata = Product::find($id);

        if($checkdata){

            Product::where ('id',$id)
                    ->update([
                        'product_name' =>$validated['product_name'],
                        'product_type' =>$validated['product_type'],
                        'product_price'=>$validated['product_price'],
                        'expired_date' =>$validated['expired_date']
                    ]);
            return response()->json([
                'messages' => 'product berhasil diupdate'
            ])->setStatusCode(201);
        }
        return response()->json([
            'messages' => 'Data tidak ada'
        ])->setStatusCode(404);
    }
    public function hapus($id){
        $checkdata = Product::find($id);
        
        if($checkdata){
            Product::destroy($id);

            return response()->json([
                'messages' => 'product berhasil dihapus'
            ])->setStatusCode(201);
        }
    return response()->json([
        'messages' => 'Data tidak ada'
    ])->setStatusCode(404);
    }
}