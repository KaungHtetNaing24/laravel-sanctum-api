<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
<style>

    body{
        padding: 100px;
    }
</style>
</head>
<body>
    

<!--Add Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('products.store') }}" method="POST">
      {{ csrf_field() }}
      <div class="modal-body">
      
      
                <div class="form-group">
                  <label for="name">Name</label>  
                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Ender Product name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="description">Description</label>  
                    <textarea name="description"  id="description" class="form-control @error('description') is-invalid @enderror"  placeholder="Ender Description"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--End Add Modal -->







<div class="container">
        <div class="row">
            
            <div class="col-md-12">

                    <h3>Products</h5>
                   
                   



                    <!-- Button trigger modal -->
                    <a href="" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-primary float-right mb-3" >
                     Add New Product
                    </button></a>

                    @if(Session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <strong>{{ Session('success') }}</strong>
                        <button class="close" data-dismiss="alert">&times;</button>
                       
                    </div>
                    @endif



               
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Models</th>
                            <th>Actions</th>
                        </tr>
                        <tbody>
                        
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                              
                                    <a href="{{ url('products/'.$product-> id.'/product-model') }}">
                                    <button type="button" class="btn btn-info btn-md">Models</button></a>
                                    
                                   
                                        <!--Edit Modal -->
                                        <div class="modal fade" id="editModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form action="{{ route('products.update',$product->id) }}" method="POST">
                                              {{ csrf_field() }}
                                              {{ method_field('PUT') }}
                                              <div class="modal-body">
                                              
                                              
                                                        <div class="form-group">
                                                          <label for="name">Name</label>  
                                                            <input type="text" name="name"  id="name" value="{{$product->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Ender Product name" >
                                                            @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="description">Description</label>  
                                                            <textarea name="description"  id="description"  class="form-control @error('description') is-invalid @enderror" placeholder="Ender Description">{{$product->description}}</textarea>
                                                            @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                              </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>

                                    
                                  </td>
                                  <td>
                                    
                                  <form action="{{url('products/'.$product->id)}}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#editModal{{$product->id}}">Edit</button>
                                    <button type="submit" class="btn btn-danger btn-md" onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                    </form>
                                  
                                  
                                  
                                    
                                  </td>
                        </tr>
                        @endforeach
                        
                        </tbody>
                        
                    </table>
                    {{ $products->links() }}
            </div>
            
        </div>
    </div>


    




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>