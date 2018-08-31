<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Listado de Liquidaciones - {{ seller_item.first_name }} {{ seller_item.last_name }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2 ml-auto">
                                <button @click.prevent="updateBook" type="button" class="btn btn-danger btn-sm btn-block">Dar de Baja</button>
                            </div>
                            <div class="col-md-2">
                                <a :href="`/clearings/${seller_item.id}/create`" type="button" class="btn btn-success btn-sm btn-block">Crear</a>
                            </div>
                        </div>
                        <h5>Cargas</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <td scope="col">Hoja de Carga</td>
                                        <td scope="col">Descripción</td>
                                        <td scope="col">Fecha de Carga</td>
                                        <td scope="col">Total</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="truck_load in truck_loads_items">
                                        <td>{{ truck_load.id }}</td>
                                        <td>{{ truck_load.description }}</td>
                                        <td>{{ truck_load.load_date }}</td>
                                        <td>{{ truck_load.total_price }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <h5>Liquidaciones</h5>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Saldo en Productos</th>
                                <th scope="col">Saldo en Dinero</th>
                                <th scope="col">Vendido</th>
                                <th scope="col">Devuelto en Productos</th>
                                <th scope="col">Créditos</th>
                                <th scope="col">Cobros</th>
                                <th scope="col">Descuentos</th>
                                <th scope="col">Gastos</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="clearing in clearings_items">
                                <td>{{ clearing.previous_products_balance }}</td>
                                <td>{{ clearing.previous_credits_balance }}</td>
                                <td>{{ clearing.income }}</td>
                                <td>{{ clearing.left_in_products }}</td>
                                <td>{{ clearing.credit }}</td>
                                <td>{{ clearing.payment }}</td>
                                <td>{{ clearing.discount }}</td>
                                <td>{{ clearing.expense }}</td>
                                <td>
                                    <a :href="`/clearings/${clearing.id}/show`" class="btn btn-info btn-sm" type="button">Mostrar</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="products_balance">Saldo en Productos</label>
                                <input class="form-control" id="products_balance" type="text" :value="products_balance_item" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="money_balance">Saldo en Dinero</label>
                                <input class="form-control" id="money_balance" type="text" :value="money_balance_item" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: [
            'seller',
            'clearings',
            'truck_loads',
            'products_balance',
            'money_balance',
            'book_id',
        ],
        data() {
            return {
                seller_item: {},
                clearings_items: [],
                truck_loads_items: [],
                products_balance_item: '',
                money_balance_item: '',
                book_id_item: '',
            }
        },
        methods: {
            checkForm() {
                this.errors = []
            },
            updateBook() {
                axios.put(`/api/books/${this.book_id_item}`,
                    {
                        products_balance: this.products_balance_item,
                        money_balance: this.money_balance_item,
                        seller: this.seller_item
                    })
                    .then((res) => {
                        swal('Muy bien!', `Baja registrada`, 'success');
                        setTimeout(() => {
                            window.location.href = '/sellers';
                        }, 2000);
                    })
                    .catch((err) => {
                        console.log('error:', err);
                    });
            },
        },
        filters: {
            roundSubPrice(value) {
                if(value) {
                    return Number.parseFloat(value).toPrecision(7);
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
            this.seller_item = JSON.parse(this.seller);
            this.clearings_items = JSON.parse(this.clearings);
            this.truck_loads_items = JSON.parse(this.truck_loads);
            this.products_balance_item = JSON.parse(this.products_balance);
            this.money_balance_item = JSON.parse(this.money_balance);
            this.book_id_item = JSON.parse(this.book_id);
        },
    }
</script>
