<template>
    <div class="row justify-content-left" style="padding-top: 40px; padding-left: 45px; gap:30px;">
        <div v-for="item in cart" :key="item.id">

            <div >
                <div class="card product-container d-flex align-items-center" style="width: 50rem; flex-direction:row;">
                    <img width="200" height="200" :src="item.img" alt="Card image cap">
                    <div>
                        <div style="display:flex; flex-direction:column;">
                            <h5 class="card-title">{{item.name}}</h5>
                            <h5 class="card-subtitle mb-3 text-muted">${{item.price}} USD</h5>

                            <p class="card-text" style="min-height: 40px; max-height: 40px;">{{item.description}}</p>
                        </div>
                        <div style="display:flex; flex-direction:row; gap:5px;">
                            <button @click="removeItem(item.id)" style="width:25px; border-radius:50%">-</button>
                            <div :id="item.id">{{item.count}}</div>
                            <button @click="addItem(item.id)" style="width:25px; border-radius:50%">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components:{

        },
        data(){
            return {
                cart:[
                ]
            }
        },
        mounted() {
            this.getCart();

        },
        methods:{

            async getCart()
            {
                try {
                    const data = await axios.get('/cart')
                    this.cart = data.data;
                } catch (error) {
                    await console.log(error)
                }
            },

            async addItem(id)
            {
                try {
                    const data = await axios.post('/cart', {"id":id} )
                    document.getElementById(id).textContent =
                    parseInt(document.getElementById(id).textContent) + 1;

                } catch (error) {
                    await console.log(error)
                }
            },
            async removeItem(id)
            {
                try {
                    const data = await axios.delete('/cart/' + id);
                    document.getElementById(id).textContent =
                    parseInt(document.getElementById(id).textContent) - 1;
                    if(parseInt(document.getElementById(id).textContent) == 0){
                        window.location.reload();
                    }
                } catch (error) {
                    await console.log("->" + error)
                }
            },

            totalPrice(){

                let sum = 0;
                this.cart.map( e => {
                    sum += e.price.toNumber();
                } );
                console.log(sum);
                return sum;
            }

        }
    }
</script>
