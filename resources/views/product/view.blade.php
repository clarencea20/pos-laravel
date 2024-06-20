<!-- View Modal -->
<div class="modal fade text-left" id="ProductView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">            
          <div class="modal-body">
          <div class="col-md-12">
                    <div class="form-group mb-2">
                        <div class="mb-3 mt-2 d-flex flex-column align-items-center">
                            <img src="{{ ($product->image) ? asset('storage/img/product/'. $product->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" class="rounded-circle" height="250px" width="250px" alt="Image">
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" id="product_name" name="product_name" value="{{ $product->product_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="product_price" name="product_price" value="{{ $product->product_price }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_quantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Product Quantity" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn px-4 float-start" style="margin-top: 10px; margin-bottom: 10px; background-color:black; color:white">Back</button>
              <button type="submit" class="btn px-4 float-end" style="margin-top: 10px; margin-bottom: 10px; background-color:black; color:white">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
