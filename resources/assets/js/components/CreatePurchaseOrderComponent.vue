<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Crear Hoja de Carga</div>

                    <div class="card-body">
                        <form @submit.prevent="storePurchaseOrder">

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <input v-model="puchase_order.description" id="description" type="text" class="form-control" name="description">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="purchase_date" class="col-md-4 col-form-label text-md-right">Fecha de Orden</label>

                                <div class="col-md-6">
                                    <input v-model="puchase_order.purchase_date" id="purchase_date" type="date" class="form-control" name="purchase_date" required>
                                </div>
                            </div>

                            <div class="row">
                                <table class="table table-hover table_morecondensed">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Sub Total</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(product, index) in products">

                                        <td>
                                            {{ product.name }} {{ product.description }}
                                        </td>
                                        <td>
                                            <input v-model="product.price" id="price" class="form-control" type="text" name="price" autocomplete="off">
                                        </td>
                                        <td>
                                            <input v-model="product.amount" id="amount" class="form-control" type="text" name="amount" autocomplete="off">
                                        </td>
                                        <td>
                                            {{ product.price * product.amount | roundSubPrice }}
                                        </td>
                                        <td>
                                            <button @click.prevent="deleteProduct(index)" type="button" class="btn btn-danger btn-sm">Quitar</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2 ml-auto">
                                    <label>Total</label>
                                </div>
                                <div class="col-md-2">
                                    {{ puchase_order.total_price }}
                                </div>
                                <div class="col-md-4">
                                    <button @click.prevent="calculateTotal" class="btn btn-success">Calcular</button>
                                </div>
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

    export default {
        data() {
            return {
                sellers: [],
                products: [],
                selected: '',
                select: '',
                remove: '',
                puchase_order: {
                    products: [],
                    description: '',
                    purchase_date: '',
                    total_price: 0.0
                },
                flag: false,
            }
        },
        methods: {
            checkForm() {
                this.errors = []
            },
            getProducts() {
                axios.get('/api/products')
                    .then((res) => {
                        this.products = res.data;
                    })
                    .catch((err) => {
                        console.log('error:', err);
                    });
            },
            storePurchaseOrder() {
                this.puchase_order.products = this.products;
                axios.post('/api/purchase-orders', this.puchase_order)
                    .then(res => {
                        if (res.status === 200) {
                            console.log(res.data);
                            swal('Muy bien!', `Carga registrada`, 'success');
                            setTimeout(() => {
                                window.location.href = '/purchase-orders';
                            }, 2000);

                        } else {
                            swal('Hubo un error!', 'No se pudo registrar Carga', 'error');
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            sellerLabel(seller) {
                return `${seller.dni} - ${seller.first_name} ${seller.last_name}`;
            },
            deleteProduct(index) {
                this.products.splice(index,1)
            },
            calculateTotal() {
                this.puchase_order.total_price = 0.0;
                this.products.map(product => {
                    if(product.amount !== undefined) {
                        this.puchase_order.total_price = this.puchase_order.total_price + (product.price * product.amount);
                    }
                });
                let number = this.puchase_order.total_price.toString().split('.')[0].length;
                this.puchase_order.total_price = this.roundPrice(this.puchase_order.total_price, number);
            },
            roundPrice(value, number) {
                return Number.parseFloat(value).toPrecision(number + 3);
            },
        },
        filters: {
            roundSubPrice(value) {
                if(value) {
                    return Number.parseFloat(value).toPrecision(5);
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getProducts();
        },
    }
</script>

<style scoped>
    .table_morecondensed>thead>tr>th,
    .table_morecondensed>tbody>tr>th,
    .table_morecondensed>tfoot>tr>th,
    .table_morecondensed>thead>tr>td,
    .table_morecondensed>tbody>tr>td,
    .table_morecondensed>tfoot>tr>td{ padding: 2px; }
</style>
