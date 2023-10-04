<template>
    <div class="d-flex align-items-center justify-content-center">
        <div class="card product-container d-flex align-items-center" style="width: 60rem;">
            <img width="400" height="400" :src="product.img" alt="Card image cap">
                <h5 class="card-title">{{product.name}}</h5>
                <h5 class="card-subtitle mb-3 text-muted">${{product.price}} USD</h5>
                <p class="card-text" style="min-height: 40px; max-height: 40px;">{{ product.description }}</p>
                <div style="display:flex; gap:5px;">
                    <button @click="addToCart(product.id)" class="btn btn-primary mb-5">Add to cart</button>
                </div>
        </div>
    </div>
</template>

<script>
	export default {
		props: ["product_id"],
		mounted() {
			this.getProduct();
		},
        data(){
            return {
                product:{}
            }
        },
		methods: {
			async addToCart(id)
            {
                try {
                    axios.post('/cart', {"id":id} ).then(
                        response => {
                            if(response.status == 200){
                                alert("new item added to cart");
                            }
                            else
                            {
                                alert("You need an account");
                                window.location.assign("/login");
                            }
                        }
                    )
                    .catch( e => {
                        alert("You need an account");
                        window.location.assign("/login");
                    } );
                } catch (error) {
                    alert("You need an account");
                    window.location.assign("/login");
                    await console.log(error)
                }
            },
            async getProduct()
            {
                try {
                    const data = await axios.get('/products/'+this.product_id)
                    this.product = data.data;
                    console.log(data.data);
                } catch (error) {
                    await console.log(error)
                }
            }
		},
	};
</script>
