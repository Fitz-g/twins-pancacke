@extends('layouts.app')

@section('title')
    Twins pancake | Home
@endsection

@section('start-page-title')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Twins Pancake</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Produits twins</a></li>
                        <li class="breadcrumb-item active">Liste des produits</li>
                    </ol>
                </div>
                <h4 class="page-title">Liste des produits</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h4 class="header-title">Liste des produits Twins Pancake</h4>
                <p class="sub-header">
                    Tableau d'affichage de la liste des produits Twins Pancake
                </p>

                <table id="datatable-buttons" class="text-center table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Code</th>
                        <th>Montant</th>
                        <th>Date création</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ number_format($product->amount, 0, ",", " ") }}</td>
                            <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <button type="button" id="sa-warning"
                                        class="btn btn-icon btn-danger waves-effect waves-light"><i
                                        class="mdi mdi-close"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <script>
        $("#datatable-buttons").DataTable({
            language: {
                url: "{{ asset('assets/js/json/dataTables.french.json') }}"
            }
        });
        $("#sa-warning").click(function(){
            Swal.fire({
                type:"warning",
                title:"Êtes-vous sûr(e) de vouloir supprimer ?",
                text:"Cette action est irréversible !",
                showCancelButton: true,
                cancelButtonText: "Annuler",
                confirmButtonColor:"#31ce77",
                cancelButtonColor:"#f34943",
                confirmButtonText: "Oui, supprimer !",
            }).then(function(t){
                t.value&&Swal.fire("Supprimé !", "Le produit a été supprimé avec succès.", "success")
            });
        });
    </script>
@endsection
