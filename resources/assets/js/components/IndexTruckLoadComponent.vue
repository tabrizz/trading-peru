<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Listar Hojas de Carga</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="from_date" class="col-md-4 col-form-label text-md-right">Desde</label>
                                <div class="form-group col-md-6">
                                    <input v-model="from_date" type="date" class="form-control" id="from_date">
                                </div>
                            </div>
                            <div class="from-group row">
                                <label for="to_date" class="col-md-4 col-form-label text-md-right">Hasta</label>
                                <div class="form-group col-md-6">
                                    <input v-model="to_date" type="date" class="form-control" id="to_date">
                                </div>
                            </div>
                            <div class="col-md-6 ml-auto">
                                <button @click.prevent="findTruckLoads" class="btn btn-primary">
                                    Buscar
                                </button>
                            </div>
                            <hr>

                            <div class="row">
                                <table class="table table-hover table_morecondensed">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Vendedor</th>
                                        <th>Fecha</th>
                                        <th>Precio Total</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(product, index) in truck_load">

                                        <td>
                                            {{ product.truck_load_id }}
                                        </td>
                                        <td>
                                            {{ product.first_name }} {{ product.last_name }}
                                        </td>
                                        <td>
                                            {{ product.load_date | formatDate }}
                                        </td>
                                        <td>
                                            {{ product.total_price | roundSubPrice }}
                                        </td>
                                        <td>
                                            <a :href="`/truck-loads/${product.truck_load_id}`" type="button" class="btn btn-info btn-sm">Ver</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
        data() {
            return {
                truck_load: [],
                from_date: '',
                to_date: '',
            }
        },
        methods: {
            checkForm() {
                this.errors = []
            },
            findTruckLoads() {
                axios.get(`/api/truck-loads-by-date/${this.from_date}/${this.to_date}`)
                    .then((res) => {
                        this.truck_load = res.data;
                    })
                    .catch((err) => {
                        console.log('error:', err);
                    });
            },
        },
        filters: {
            roundSubPrice(value) {
                if(value) {
                    return Number.parseFloat(value).toPrecision(3);
                }
            },
            formatDate(value) {
                if(value) {
                    return moment(String(value)).format('DD-MM-YYYY');
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
    }
</script>
