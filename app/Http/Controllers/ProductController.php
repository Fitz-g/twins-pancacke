<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Classroom;
use App\Models\Product;
use App\Models\School;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:2|unique:products",
            "amount" => "required|integer",
            "description" => "nullable",
        ], [
            "name.required" => "Le nom de la classe est obligatoire",
            "name.min" => "Le nom de la classe doit avoir au moins 2 caractères",
            "name.unique" => "Le nom existe déjà dans la base de données",
            "amount.required" => "Veuillez ajouter le montant du produit s'il vous plaît.",
            "amount.integer" => "Le montant n'est pas au bon format.",
        ]);
        if ($validator->fails()) {
            Log::error("Tentative de création de produits échouée " . json_encode($request->all()) . '/ user ID : ' . Auth::id());
            toastr()->warning("Veuillez renseigner correctement les champs");
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $data = $request->except('_token', '_method');
            $data["slug"] = Str::slug($data["name"]);
            $data["code"] = Helper::generateCodeByName($data["name"]);
            Product::create($data);
            toastr()->success("Un produit a été ajouté avec succès.");
            return redirect()->route("products.index");
        } catch (\Exception $e) {
            Log::error("Une erreur est survenue : " . $e->getMessage());
            toastr()->error("Une erreur est survenue, veuillez reessayer ou contacter l'administrateur.");
            return redirect()->route("products.create");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
