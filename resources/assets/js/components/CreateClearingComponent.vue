<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Crear Liquidación - {{ first_name }} {{ last_name }}</div>

                    <div class="card-body">
                        <form @submit.prevent="storeClearing">

                            <div class="row">
                                <table class="table table-hover table_morecondensed">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Restante</th>
                                        <th>Vendido</th>
                                        <th>Sub Total Restante</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in clearing.products">

                                        <td>
                                            {{ product.name }} {{ product.description }}
                                        </td>
                                        <td>
                                            <input v-model="product.price" id="price" class="form-control" type="text" name="price" disabled>
                                        </td>
                                        <td>
                                            <input v-model="product.amount" id="amount" class="form-control" type="text" name="amount" disabled>
                                        </td>
                                        <td>
                                            <input v-model="product.left" id="left" class="form-control" type="text" name="left" autocomplete="off">
                                        </td>
                                        <td>
                                            {{ product.amount - product.left | roundValue }}
                                        </td>
                                        <td>
                                            {{ product.price * product.left | roundSubPrice }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2 ml-auto">
                                    <label>Total Vendido:</label>
                                    {{ clearing.income }}
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <label>Total Restante:</label>
                                    {{ clearing.left_in_products }}
                                </div>
                                <div class="col-md-4">
                                    <button @click.prevent="calculateTotal" class="btn btn-success">Calcular</button>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <h5>Listado de Créditos</h5>
                                <div class="form-group col-md-2 ml-auto">
                                    <button @click.prevent="addCredit" class="btn btn-success btn-sm btn-block">Agregar Crédito</button>
                                </div>
                            </div>
                            <div class="form-row" v-for="(credit, index) in clearing.credits">
                                <div class="form-group col-md-6">
                                    <label for="credit_description">Descripción del Crédito</label>
                                    <input v-model="credit.description" type="text" class="form-control" id="credit_description">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="credit_price">Precio</label>
                                    <input v-model="credit.price" type="text" class="form-control" id="credit_price">
                                </div>
                                <div class="form-group col-md-2">
                                    <br>
                                    <button @click.prevent="removeCredit(index)" class="btn btn-danger btn-sm">x</button>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <h5>Listado de Cobranzas</h5>
                                <div class="form-group col-md-2 ml-auto">
                                    <button @click.prevent="addPayment" class="btn btn-success btn-sm btn-block">Agregar Cobranza</button>
                                </div>
                            </div>
                            <div class="form-row" v-for="(payment, index) in clearing.payments">
                                <div class="form-group col-md-6">
                                    <label for="payment_description">Descripción de la Cobranza</label>
                                    <input v-model="payment.description" type="text" class="form-control" id="payment_description">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="payment_price">Precio</label>
                                    <input v-model="payment.price" type="text" class="form-control" id="payment_price">
                                </div>
                                <div class="form-group col-md-2">
                                    <br>
                                    <button @click.prevent="removeCredit(index)" class="btn btn-danger btn-sm">x</button>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <h5>Listado de Descuentos</h5>
                                <div class="form-group col-md-2 ml-auto">
                                    <button @click.prevent="addDiscount" class="btn btn-success btn-sm btn-block">Agregar Descuento</button>
                                </div>
                            </div>
                            <div class="form-row" v-for="(discount, index) in clearing.discounts">
                                <div class="form-group col-md-6">
                                    <label for="discount_description">Descripción del Descuento</label>
                                    <input v-model="discount.description" type="text" class="form-control" id="discount_description">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="discount_price">Precio</label>
                                    <input v-model="discount.price" type="text" class="form-control" id="discount_price">
                                </div>
                                <div class="form-group col-md-2">
                                    <br>
                                    <button @click.prevent="removeDiscount(index)" class="btn btn-danger btn-sm">x</button>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <h5>Listado de Gastos</h5>
                                <div class="form-group col-md-2 ml-auto">
                                    <button @click.prevent="addExpense" class="btn btn-success btn-sm btn-block">Agregar Gasto</button>
                                </div>
                            </div>
                            <div class="form-row" v-for="(expense, index) in clearing.expenses">
                                <div class="form-group col-md-6">
                                    <label for="expense_description">Descripción del Gasto</label>
                                    <input v-model="expense.description" type="text" class="form-control" id="expense_description">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="expense_price">Precio</label>
                                    <input v-model="expense.price" type="text" class="form-control" id="expense_price">
                                </div>
                                <div class="form-group col-md-2">
                                    <br>
                                    <button @click.prevent="removeExpense(index)" class="btn btn-danger btn-sm">x</button>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="bill_100">100</label>
                                    <input v-model="clearing.bill_100" type="text" class="form-control" id="bill_100">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="bill_50">50</label>
                                    <input v-model="clearing.bill_50" type="text" class="form-control" id="bill_50">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="bill_20">20</label>
                                    <input v-model="clearing.bill_20" type="text" class="form-control" id="bill_20">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="bill_10">10</label>
                                    <input v-model="clearing.bill_10" type="text" class="form-control" id="bill_10">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="coin_5">5</label>
                                    <input v-model="clearing.coin_5" type="text" class="form-control" id="coin_5">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="coin_2">2</label>
                                    <input v-model="clearing.coin_2" type="text" class="form-control" id="coin_2">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="coin_1">1</label>
                                    <input v-model="clearing.coin_1" type="text" class="form-control" id="coin_1">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="50_cent">0.50</label>
                                    <input v-model="clearing.cent_50" type="text" class="form-control" id="50_cent">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cent_20">0.20</label>
                                    <input v-model="clearing.cent_20" type="text" class="form-control" id="cent_20">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cent_10">0.10</label>
                                    <input v-model="clearing.cent_10" type="text" class="form-control" id="cent_10">
                                </div>
                            </div>
                            <hr>

                            <div class="col-md-6 ml-auto">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>

                                <a type="button" class="btn btn-danger" href="/sellers">
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
        props: ['seller_product_bag'],
        data() {
            return {
                clearing: {
                    products: [],
                    expenses: [],
                    discounts: [],
                    credits: [],
                    payments: [],
                    income: 0.0,
                    left_in_products: 0.0,
                    expense: 0.0,
                    discount: 0.0,
                    credit: 0.0,
                    payment: 0.0,
                    bill_100: 0,
                    bill_50: 0,
                    bill_20: 0,
                    bill_10: 0,
                    coin_5: 0,
                    coin_2: 0,
                    coin_1: 0,
                    cent_50: 0,
                    cent_20: 0,
                    cent_10: 0,
                },
                first_name: '',
                last_name: '',
            }
        },
        methods: {
            checkForm() {
                this.errors = []
            },
            storeClearing() {
                this.calculateTotal();
                axios.post('/api/store-clearings', this.clearing)
                    .then(res => {
                        if (res.status === 200) {
                            // swal('Muy bien!', `Liquidación registrada`, 'success');
                            // setTimeout(() => {
                            //     window.location.href = '/sellers';
                            // }, 2000);

                        } else {
                            swal('Hubo un error!', 'No se pudo registrar Liquidación', 'error');
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            calculateTotal() {
                this.clearing.income = 0.0;
                this.clearing.left_in_products = 0.0;
                this.clearing.products.map(product => {
                    if(product.left !== undefined) {
                        this.clearing.income = this.clearing.income + (product.price * (product.amount - product.left));
                    } else {
                        this.clearing.income = this.clearing.income + (product.price * product.amount);
                    }
                    if(product.left !== undefined) {
                        this.clearing.left_in_products = this.clearing.left_in_products + (product.price * product.left);
                    }
                });
                let number1 = this.clearing.income.toString().split('.')[0].length;
                let number2 = this.clearing.left_in_products.toString().split('.')[0].length;
                this.clearing.income = this.roundPrice(this.clearing.income, number1);
                this.clearing.left_in_products = this.roundPrice(this.clearing.left_in_products, number2);

                let n;
                if (this.clearing.expenses.length > 0) {
                    n = 0;
                    this.clearing.expense = this.calculatePrice(this.clearing.expenses);
                    n = this.clearing.expense.toString().split('.')[0].length;
                    this.clearing.expense = this.roundPrice(this.clearing.expense, n);
                }
                if (this.clearing.discounts.length > 0) {
                    n = 0;
                    this.clearing.discount = this.calculatePrice(this.clearing.discounts);
                    n = this.clearing.discount.toString().split('.')[0].length;
                    this.clearing.discount = this.roundPrice(this.clearing.discount, n);
                }
                if (this.clearing.credits.length > 0) {
                    n = 0;
                    this.clearing.credit = this.calculatePrice(this.clearing.credits);
                    n = this.clearing.credit.toString().split('.')[0].length;
                    this.clearing.credit = this.roundPrice(this.clearing.credit, n);
                }
                if (this.clearing.payments.length > 0) {
                    n = 0;
                    this.clearing.payment = this.calculatePrice(this.clearing.payments);
                    n = this.clearing.payment.toString().split('.')[0].length;
                    this.clearing.payment = this.roundPrice(this.clearing.payment, n);
                }
                console.log('income', this.clearing.income);
                console.log('left_in_products', this.clearing.left_in_products);
                console.log('expense', this.clearing.expense);
                console.log('discount', this.clearing.discount);
                console.log('credit', this.clearing.credit);
                console.log('payment', this.clearing.payment);
            },
            addExpense() {
                this.clearing.expenses.push({description: '', price: ''})
            },
            removeExpense(index) {
                this.clearing.expenses.splice(index, 1);
            },
            addDiscount() {
                this.clearing.discounts.push({description: '', price: ''})
            },
            removeDiscount(index) {
                this.clearing.discounts.splice(index, 1);
            },
            addCredit() {
                this.clearing.credits.push({description: '', price: ''})
            },
            removeCredit(index) {
                this.clearing.credits.splice(index, 1);
            },
            addPayment() {
                this.clearing.payments.push({description: '', price: ''})
            },
            removePayment(index) {
                this.clearing.payments.splice(index, 1);
            },
            roundPrice(value, number) {
                return Number.parseFloat(value).toPrecision(number + 3);
            },
            calculatePrice(items) {
                let total = 0.0
                items.map(item => {
                    total = total + item.price;
                });

                return total;
            }
        },
        filters: {
            roundSubPrice(value) {
                if(value) {
                    return Number.parseFloat(value).toPrecision(5);
                }
            },
            roundValue(value) {
                if(value) {
                    return value;
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.clearing.products = JSON.parse(this.seller_product_bag);
            if (this.clearing.products !== undefined && this.clearing.products.length > 0) {
                this.clearing.seller_id = this.clearing.products[0].seller_id;
                this.first_name = this.clearing.products[0].first_name;
                this.last_name = this.clearing.products[0].last_name;
            }
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
