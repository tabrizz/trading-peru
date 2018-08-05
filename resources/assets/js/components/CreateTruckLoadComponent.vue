<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Crear Hoja de Carga</div>

                    <div class="card-body">
                        <form @submit.prevent="">

                            <div class="form-group row">
                                <label for="seller_id" class="col-md-4 col-form-label text-md-right">Vendedor</label>

                                <div class="col-md-6">
                                    <multiselect
                                            id="seller_id"
                                            v-model="truck_load.seller"
                                            :options="sellers"
                                            placeholder="Seleccione el Vendedor"
                                            :custom-label="sellerLabel"
                                            :selectedLabel="selected"
                                            :deselectLabel="remove"
                                            :selectLabel="select">
                                    </multiselect>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <input v-model="truck_load.description" id="description" type="text" class="form-control" name="description">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="load_date" class="col-md-4 col-form-label text-md-right">Fecha de Carga</label>

                                <div class="col-md-6">
                                    <input v-model="truck_load.load_date" id="load_date" type="date" class="form-control" name="amount" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="col-md-3 ml-auto">
                                        <button @click="addProduct" type="button" class="btn btn-success">Agregar Producto</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cant. Importe</th>
                                        <th>Importe</th>
                                        <th>Cantidad</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(product_item, index) in truck_load.products">
                                        <td class="col-sm-6">
                                            <multiselect
                                                    v-model="product_item.product"
                                                    :options="products"
                                                    placeholder="Seleccione el Producto"
                                                    :custom-label="productLabel"
                                                    :selectedLabel="selected"
                                                    :deselectLabel="remove"
                                                    :selectLabel="select">
                                            </multiselect>
                                        </td>
                                        <td>
                                            <input v-model="product_item.a_price" id="a_price" class="form-control" type="text" name="a_price" required>
                                        </td>
                                        <td>
                                            <input v-model="product_item.price" id="price" class="form-control" type="text" name="price" required>
                                        </td>
                                        <td>
                                            <input v-model="product_item.amount" id="amount" class="form-control" type="text" name="amount" required>
                                        </td>
                                        <td>
                                            <button @click.prevent="deleteProduct(index)" type="button" class="btn btn-danger btn-sm">Quitar</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6 ml-auto">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>

                                <a type="button" class="btn btn-danger" href="/truck-loads">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            Multiselect
        },
        data() {
            return {
                sellers: [],
                products: [],
                selected: '',
                select: '',
                remove: '',
                truck_load: {
                    seller: '',
                    products: [],
                    description: '',
                    load_date: '',
                },
                flag: false
            }
        },
        methods: {
            checkForm() {
                this.errors = []
            },
            getSellers() {
                axios.get('/api/sellers')
                    .then((res) => {
                        this.sellers = res.data;
                    })
                    .catch((err) => {
                        console.log('error:', err);
                    });
            },
            getProducts() {
                axios.get('/api/products')
                    .then((res) => {
                        this.products = res.data;
                        console.log(this.products);
                    })
                    .catch((err) => {
                        console.log('error:', err);
                    });
            },
            sellerLabel(seller) {
                return `${seller.dni} - ${seller.first_name} ${seller.last_name}`;
            },
            productLabel(product) {
                return `${product.name} - ${product.description}`;
            },
            addProduct() {
                this.truck_load.products.push({
                    product: '', a_price: '', price: '',amount: ''});
            },
            deleteProduct(index) {
                this.truck_load.products.splice(index,1)
            },
        },
        mounted() {
            console.log('Component mounted.');
            this.getSellers();
            this.getProducts();
        },
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
