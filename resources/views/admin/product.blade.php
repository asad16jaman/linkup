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
        padding: 2px !important;
        margin-bottom: 2px;
    }

    .productimages {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.preview-img {
    position: relative;
    display: inline-block;
}
.preview-img img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.preview-img .remove-btn {
    position: absolute;
    top: -5px;
    right: -5px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    cursor: pointer;
}

</style>
@endsection

@section('bodyContent')

    <div class="container">

        <div class="page-inner">

            <div class="card mb-1">
                <div class="card-header pt-1 pb-0">
                    <h4 class="text-center">Create Service</h4>
                </div>
                <form method="post" id="productForm" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control p-1"  name="name" value="{{ $editItem ? $editItem->name : "" }}"
                                            placeholder="Enter Product Name">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="description">Discription :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea name="description" class="form-control" rows="2" id="">{{ $editItem ? $editItem->description : "" }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="long_Description">Long Discription :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <textarea name="logn_description" class="form-control" rows="4" id="">{{ $editItem ? $editItem->logn_description : "" }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row mb-2">
                                    <div class="col-md-3 col-12">
                                        <div class="">
                                            <label for="email2">Catagory :</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <select name="category_id" id="" class="form-control">
                                            <!-- <option value="1">dkslk</option>
                                            <option value="1">dkslk</option> -->
                                            
                                            @if($editItem != null)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected($editItem->category->id == $category->id) >{{ $category->name }}</option>
                                                    @endforeach
                                            @else

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach

                                            @endif

                                        </select>
                                    </div>
                                </div>
                                @if($editItem == null)
                                <div class="row">
                                    
                                        <div class="col-md-3 col-12">
                                            <div class="">
                                                <label for="email2">Service Image </label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-12">
                                           <input type="file" name="img[]" id="productImages" class="form-control" multiple accept="image/*">
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="productimages d-flex flex-wrap gap-2"></div>
                                    </div>
                                </div>

                                @else
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        If You Want to edit Image. You Need To Delete Product And Add New Product With New Image
                                    </div>
                                </div>

                                @endif
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
                            <h5 class="card-title ">ALL Services</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="basic-datatables_length">
                                                <label>Show <select
                                                        name="basic-datatables_length" aria-controls="basic-datatables"
                                                        class="form-control form-control-sm" onchange="perpageItem(this)">
                                                        <option value="3" >3</option>
                                                        <option value="4" @selected( request()->query('numberOfItem') == 4 )>4</option>
                                                        <option value="50" @selected(request()->query('numberOfItem') == 50)>50</option>
                                                        <option value="100" @selected(request()->query('numberOfItem') == 100) >100</option>
                                                    </select> entries</label>
                                                </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="basic-datatables_filter" class="dataTables_filter">
                                                <label class="d-flex justify-content-end">Search:
                                                    <form id="searchform">
                                                        @csrf
                                                        <input type="search" value="{{ request()->query('search') }}" name="search" class="form-control form-control-sm"
                                                            placeholder="" aria-controls="basic-datatables">
                                                    </form>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="basic-datatables"
                                                class="display table table-striped table-hover dataTable" role="grid"
                                                aria-describedby="basic-datatables_info">
                                                <thead class="headbg">
                                                    <tr role="row bg-dark" >
                                                        <th style="width: 136.031px;">SL NO:</th>
                                                        <th style="width: 214.469px;">Name</th>
                                                        <th style="width: 214.469px;">Description</th>
                                                        <th style="width: 214.469px;">Long Des.</th>
                                                        <th style="width: 101.219px;">Category</th>
                                                        <th style="width: 35.875px;">Image</th>
                                                        <th style="width: 81.375px;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                @forelse($products as $product)
                                                    <tr role="row" class="odd" >
                                                        <td class="sorting_1">{{ $loop->iteration }}</td>
                                                        <td>
                                                        
                                                            {{ $product->name }}
                                                        </td>
                                                        <td>{{ substr($product->description,0,50) }}...</td>
                                                        <td>{{ substr($product->logn_description,0,50) }}...</td>
                                                        
                                                        <td>{{ $product->category->name }}</td>
                                                        <td><a href="">Image</a></td>
                                                        <td class="d-flex justify-content-center">
                                                            
                                                            <a href="{{ route('admin.product',['id'=> $product->id]) }}" class="btn btn-info p-1 me-1">
                                                                <i class="fas fa-edit iconsize"></i>
                                                            </a>

                                                            <form action="{{ route('admin.product.delete',['id'=>$product->id]) }}" method="post">
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

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end">
                                                @php
                                                    $nextCursor = $products->nextCursor()?->encode();
                                                    $prevCursor = $products->previousCursor()?->encode();
                                                @endphp

                                                {{-- Previous Button --}}
                                                @if($prevCursor)
                                                    <a href="{{ request()->fullUrlWithQuery(['cursor' => $prevCursor]) }}" class="btn btn-primary p-1">« Previous</a>
                                                @endif

                                                {{-- Next Button --}}
                                                @if($nextCursor)
                                                    <a href="{{ request()->fullUrlWithQuery(['cursor' => $nextCursor]) }}" class="btn btn-primary mx-3 p-1">Next »</a>
                                                @endif
                                            </div>
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
    function perpageItem(d){
        let itemNumber = d.value;
        let baseUrl = "{{ url()->current() }}"; // current route path without query

        const url = new URL(baseUrl, window.location.origin);
        @foreach(request()->query() as $key => $value)
            @if($key !== 'numberOfItem')
                url.searchParams.set('{{ $key }}', '{{ $value }}');
            @endif
        @endforeach

        url.searchParams.set('numberOfItem', itemNumber);
        window.location.href = url.toString();
    }


   

    document.getElementById('searchform').addEventListener('submit',function(e){
        e.preventDefault();
        let searchValue = e.target['search'].value ; 
        let baseUrl = "{{ url()->current() }}"; // current route path without query

        const url = new URL(baseUrl, window.location.origin);
        @foreach(request()->query() as $key => $value)
            @if($key !== 'search')
                url.searchParams.set('{{ $key }}', '{{ $value }}');
            @endif
        @endforeach
       
        url.searchParams.set('search', searchValue);
        window.location.href = url.toString();
    })

    @if($editItem == null)
    //handle product multiple image start hare........................................

    
    const input = document.getElementById('productImages');
    const previewContainer = document.querySelector('.productimages');
    let imageFiles = [];

    input.addEventListener('change', function (e) {
        const files = Array.from(e.target.files);
        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                const preview = document.createElement('div');
                preview.classList.add('preview-img');

                preview.innerHTML = `
                    <img src="${event.target.result}" alt="preview">
                    <button class="remove-btn">&times;</button>
                `;

                // Remove on click
                preview.querySelector('.remove-btn').addEventListener('click', function () {
                    const index = imageFiles.indexOf(file);
                    if (index > -1) {
                        imageFiles.splice(index, 1);
                    }
                    preview.remove();
                });

                previewContainer.appendChild(preview);
            };
            reader.readAsDataURL(file);

            imageFiles.push(file);
        });

        // Reset input to allow re-upload of same file
        input.value = '';
    });

    


    //handle product multiple image end hare........................................


    // form submission .......................

    document.getElementById('productForm').addEventListener('submit', function(e) {
    e.preventDefault(); 
    const form = e.target;
    const formData = new FormData(form);

    // adding file 
    imageFiles.forEach(file => {
        formData.append('img[]', file);
    });

    fetch("{{ route('admin.product') }}", {
        method: 'POST',
        body: formData,
    })
    .then(res => res.json())
    .then(data => {
        
        window.location.href = "{{ route('admin.product') }}"
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

@endif

    
</script>

@endpush