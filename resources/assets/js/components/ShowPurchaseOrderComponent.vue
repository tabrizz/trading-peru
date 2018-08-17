<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Hoja de Carga</div>

                    <div class="card-body">
                        <form @submit.prevent="storeTruckLoadProducts">

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <input v-model="description" id="description" type="text" class="form-control" name="description" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="purchase_date" class="col-md-4 col-form-label text-md-right">Fecha de Compra</label>

                                <div class="col-md-6">
                                    <input :value="purchase_date" id="purchase_date" type="text" class="form-control" name="amount" disabled>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(product, index) in purchase_order_items">

                                        <td>
                                            {{ product.name }} {{ product.description }}
                                        </td>
                                        <td>
                                            {{ product.amount }}
                                        </td>
                                        <td>
                                            {{ product.price }}
                                        </td>
                                        <td>
                                            {{ product.price * product.amount | roundSubPrice }}
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
                                    {{ total_price | roundSubPrice }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: ['purchase_order'],
        data() {
            return {
                purchase_order_items: [],
                first_name: '',
                last_name: '',
                description: '',
                purchase_date: '',
                total_price: ''
            }
        },
        methods: {

        },
        filters: {
            roundSubPrice(value) {
                if(value) {
                    return Number.parseFloat(value).toPrecision(3);
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.purchase_order_items = JSON.parse(this.purchase_order);
            this.first_name = this.purchase_order_items[0].first_name;
            this.last_name = this.purchase_order_items[0].last_name;
            this.description = this.purchase_order_items[0].purchase_order_description;
            this.purchase_date = moment(this.purchase_order_items[0].purchase_date).format('DD-MM-YYYY h:mm:ss');
            this.total_price = this.purchase_order_items[0].total_price;
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
