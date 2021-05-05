@extends('layout.master')
@section('content')
    <div class="container py-5" id="app">
        <div class="card">
            <div class="card-header">
                <h2>Manage Products</h2>
            </div>
            <div class="card-body">


                <div class="row mb-3">
                    <div class="col-md-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-address-card" aria-hidden="true">Add New</i>
                        </button>
                    </div>
                    <div class="col-md-6" >
                        <div class="form-inline justify-content-end">
                            <div class="form-group">
                                <div class="input-group">
                                  <input type="search" v-model="filter.name" class="form-control" placeholder="Search...">
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" v-show="filter.name.length > 0" @click="clearText()" type="button"><i class="fas fa-sync-alt"></i></button>
                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th :class="classes('name')" @click="sort('name')">Product Name</th>
                            <th :class="classes('category')" @click="sort('category')">Category</th>
                            <th :class="classes('price')" :class="classes" @click="sort('price')">Price</th>
                            <th role="col">Action</th>
                         </tr>
                    </thead>
                    <tbody data-source="{{route('products.index')}}">
                        <tr v-for="product of paginateProducts">
                            <td >{!product.name!}</td>
                            <td v-text="product.category"></td>
                            <td v-text="product.price"></td>
                            <td><button v-bind="product=product" class="btn btn-warning" data-toggle ="modal" data-target="#exampleModalCenter">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav>
                  <ul class="pagination justify-content-center">    
                    <li class="page-item"><a class="page-link" @click="prev()" >Previous</a></li>
                    <li class="page-item " :class="page == currentPage?'active':''" v-for="page in pages"@click="currentPage=page" ><a class="page-link" v-text="page"></a></li>
                    <li class="page-item"><a class="page-link" @click="next()" >Next</a></li>
                  </ul>
                </nav>
            </div>
        </div>

<!-- form modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
  </button> -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="create_product"
        action-target="{{route('products.store')}}" data-source="{{route('categories')}}">
            <form >
                @csrf
                <div class="form-group">
                    <label>Product Name</label>
                    <input v-model="product.name" type="text" class="form-control" :class="">
                    <span class="invalid-feedback" v-if="errors.name" v-text="errors.name[0]"></span>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    
                    <select class="form-control" v-model="product.category" >
                        <option v-bind:value="category.id" v-text="category.name"  v-for="category in categories"></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price ($)</label>
                    <input v-model="product.price" type="number" class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="saveProduct()">Save changes</button> 
        </div>
      </div>
    </div>
  </div>
@endsection
