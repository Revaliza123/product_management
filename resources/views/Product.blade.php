<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product Management</h1>

        <!-- Button to Open the Modal -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Product
            </button>
        </div>

        <!-- Add Modal -->
        <div class="modal" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Tambah Produk -->
                        <form id="addProductForm" action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <!-- Kolom lain -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukan nama product" required>
                            </div>
                            <div class="mb-3">
                                <label for="production_date" class="form-label">Production Date</label>
                                <input type="date" class="form-control" id="production_date" name="production_date"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="expired_date" class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" id="expired_date" name="expired_date"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    placeholder="Masukan jumlah quantity product" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text mb-0">Production Date: {{ $product->production_date }}</p>
                            <p class="card-text mb-0">Expired Date: {{ $product->expired_date }}</p>
                            <p class="card-text">Quantity: {{ $product->quantity }}Kg</p>
                            <div class="dropdown position-absolute top-0 end-0">
                                <button class="btn border-0" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $product->id }}">Edit</button></li>
                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}">Delete</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal -->
                <div class="modal" id="editModal-{{ $product->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Product</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('products.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $product->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="production_date" class="form-label">Production Date</label>
                                        <input type="date" class="form-control" id="production_date"
                                            name="production_date" value="{{ $product->production_date }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="expired_date" class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" id="expired_date"
                                            name="expired_date" value="{{ $product->expired_date }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" id="expired_date" name="quantity"
                                            value="{{ $product->quantity }}" required>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            </tbody>
            </table>
            
            <!-- Delete Confirmation Modal -->
            <div class="modal" id="deleteModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Product</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <p>Are you sure you want to delete this product?</p>
                            </div>
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" id="product_id">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-danger me-2">Delete</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-5">
            {{ $products->links() }}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var productId = button.getAttribute('data-id');
                var productName = button.getAttribute('data-name');

                var modalBody = deleteModal.querySelector('.modal-body p');
                modalBody.textContent = 'Are you sure you want to delete the product "' + productName + '"?';

                var form = deleteModal.querySelector('form');
                form.action = '/products/' + productId;
            });
        </script>
</body>

</html>
