@extends('admin.layout.app')

@section('title', 'Admin Page')

@section('style')
<style>
    .table > tbody > tr > td{
        padding: 0px !important;
        margin-bottom: 2px;
    }
    .iconsize{
        font-size: 15px;
    }
    .profileImg{
        width: auto;
        height: 100px; 
        object-fit: cover;
        border: 2px dashed #ccc;
        border-radius: 6px;
    }
    .tablepicture{
        width: 30px;
        height: 30px;
        object-fit: fill;
    }
    .headbg > tr > th{
        background-color: #3c5236;
        color: #fff;
    }
</style>
@endsection

@php
    $editcategory = null
@endphp

@section('bodyContent')

    <div class="container">

        <div class="page-inner">

            <div class="card">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Category</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-3 ">
                        <div class="row">

                            <div class="col-md-6 col-12">
                               

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Name :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1"  name="name" value="{{ $editclient ? $editclient->name : '' }}"
                                            placeholder="Enter Full Name">
                                    </div>
                                </div>

                                

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="bio">Note</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea class="form-control"  name="note" placeholder="" id="comment" rows="3">{{ $editclient ? $editclient->note : '' }}</textarea>
                                    </div>
                                </div>

                                
                                
                            </div>

                            <div class="col-md-6 col-12">

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Phone :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" class="form-control p-1"  name="phone_number" value="{{ $editclient ? $editclient->phone_number : '' }}"
                                            placeholder="Enter Phone Number">
                                    </div>
                                </div>
                        
                                            <div class="row">
                                                <div class="col-md-12 col-12 d-flex justify-content-center mt-1">
                                                    <label for="imageInput" style="cursor: pointer;">
                                                        <!-- (placeholder) -->
                                                        <img id="previewImage" 
                                                            src="{{ $editclient ?  asset('storage/'.$editclient->photo) : asset('assets/admin/img/demoProfile.png') }}" 
                                                            alt="Demo Image" 
                                                            class="profileImg"
                                                            style="">
                                                    </label>

                                                    <!-- hidden input -->
                                                    <input type="file" name="photo" id="imageInput" accept="image/*" style="display: none;">
                                                </div>
                                            </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                           <input type="submit" value="Submit" class="btn btn-primary me-3 p-2">
                        </div>
                    </div>
                </form>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <h5 class="card-title ">ALL Clients</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        
                                        <!-- <div class="col-sm-12 col-md-6">
                                            <div id="basic-datatables_filter" class="dataTables_filter">
                                                <label class="d-flex justify-content-end">Search:
                                                    <form id="searchform">
                                                       
                                                        <input type="search" value="" name="search" class="form-control form-control-sm"
                                                            placeholder="" aria-controls="basic-datatables">
                                                    </form>
                                                </label>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="basic-datatables"
                                                class="display table table-striped table-hover dataTable" role="grid"
                                                aria-describedby="basic-datatables_info">
                                                <thead class="headbg">
                                                    <tr role="row bg-dark" >
                                                        <th style="width: 136.031px;">SL NO:</th>
                                                        <th style="width: 214.469px;">Picture</th>
                                                        <th style="width: 214.469px;">Name</th>
                                                        <th style="width: 214.469px;">Phone</th>
                                                        <th style="width: 214.469px;">Note</th>
                                            
                                                        <th style="width: 81.375px;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                
                                               
                                                @forelse($allclient as $team)
                                                    <tr role="row" class="odd" >
                                                        <td class="sorting_1">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img class="tablepicture" src="{{ $team->photo ?  asset('storage/'.$team->photo ) : asset('assets/admin/img/demoProfile.png') }}" alt="user profile picture">
                                                        </td>
                                                        <td>{{ $team->name }}</td>
                                                        <td>{{ $team->phone }}</td>
                                                        <td>{{ substr($team->note,0,20) }}...</td>
                                                        
                                                        <td class="d-flex justify-content-center">
                                                            
                                                            <a href="{{ route('admin.client',['id'=>$team->id]) }}" class="btn btn-info p-1 me-1">
                                                                <i class="fas fa-edit iconsize"></i>
                                                            </a>

                                                            <form action="{{ route('admin.client.delete',['id' => $team->id]) }}" method="post">
                                                                @csrf
                                                                <!-- <input type="submit" value="Delete"> -->
                                                                 <button type="submit" class="btn btn-danger p-1"><i class="fas fa-trash-alt iconsize"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <p>there is no users</p>

                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection

@push('script')
<script>
    
   
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    })
</script>

@endpush