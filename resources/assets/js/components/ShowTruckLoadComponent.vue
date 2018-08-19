<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Hoja de Carga</div>

                    <div class="card-body">
                        <form @submit.prevent="storeTruckLoadProducts">

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">Vendedor</label>

                                <div class="col-md-3">
                                    <input :value="last_name" id="last_name" type="text" class="form-control" name="last_name" disabled>
                                </div>
                                <div class="col-md-3">
                                    <input :value="first_name" id="first_name" type="text" class="form-control" name="first_name" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <input v-model="description" id="description" type="text" class="form-control" name="description" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="load_date" class="col-md-4 col-form-label text-md-right">Fecha de Carga</label>

                                <div class="col-md-6">
                                    <input :value="load_date" id="load_date" type="text" class="form-control" name="amount" disabled>
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
                                    <tr v-for="(product, index) in truck_load_items">

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
                                    {{ total_price }}
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
        props: ['truck_load'],
        data() {
            return {
                truck_load_items: [],
                first_name: '',
                last_name: '',
                description: '',
                load_date: '',
                total_price: ''
            }
        },
        methods: {

        },
        filters: {
            roundSubPrice(value) {
                if(value) {
                    return Number.parseFloat(value).toPrecision(6);
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.truck_load_items = JSON.parse(this.truck_load);
            this.first_name = this.truck_load_items[0].first_name;
            this.last_name = this.truck_load_items[0].last_name;
            this.description = this.truck_load_items[0].truck_load_description;
            this.load_date = moment(this.truck_load_items[0].load_date).format('DD-MM-YYYY h:mm:ss');
            this.total_price = this.truck_load_items[0].total_price;
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
