<template>
    <div class="card product-container" style="width: 17rem;">
    <img class="card-img-top" :src="img" alt="Card image cap" height="200">
    <div class="card-body">
        <h5 class="card-title">{{title}}</h5>
        <h5 class="card-subtitle mb-3 text-muted">${{price}} USD</h5>
        <p class="card-text"
        style="min-height: 40px; max-height: 40px;"
        >{{ description }}</p>
        <div style="display:flex; gap:5px;">
            <a :href="/products/ + id" class="btn btn-primary">View</a>
            <a href="#" @click="addToCart(id)" class="btn btn-primary">Add to cart</a>

        </div>

    </div>
</div>
</template>

<script>
    export default {
        props:[
            "id",
            "img",
            "title",
            "price",
            "description",
            ],
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
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
        }
    }
</script>
