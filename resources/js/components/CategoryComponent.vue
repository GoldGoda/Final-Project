<template>
    <div class="row justify-content-left" style="padding-top: 40px; padding-left: 45px; gap:30px;">
        <div class="col-md-12">
            <p style="margin-bottom:15px;" class="h3">{{name}} <a :href="/categories/ + id">{{show ? "See more ❯" : ""}}   </a></p>
            <div style="display: flex; flex-direction:row; gap:20px; flex-wrap: wrap;">
                <div v-for="(product, index) in isFixed()" :key="index">
                    <product-component :id="product.id" :img="product.img" :title="product.name" :price="product.price" :description="reduceDescription(product.description)"></product-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductComponent from './ProductComponent.vue'
    export default {
        components:{
            ProductComponent
        },
        props:[
            "id",
            "name",
            "show",
            "byName",
        ],
        data(){
            return {
                productList:[
                ]
            }
        },
        mounted() {
            this.getCategories();
        },
        methods:{
            addToCart(){
                alert('cart')
            },
            isFixed(){
                if(this.byName == "" || this.byName == null){
                    if( this.show == null ){ return this.productList; }
                    return this.productList.slice(0, this.show);
                }
                else
                {
                    if( this.show == null ){
                        let productList = this.productList;
                        let result = this.searchProduct(this.byName, productList);
                        return result;
                    }
                    let productList = this.productList.slice(0, this.show);
                    let result = this.searchProduct(this.byName, productList);
                    return result;
                }
            },
            reduceDescription(text) {
                const description = text;
                if (description.length > 40) {
                const descTrunc = description.substring(0, 40) + '... ';
                    return descTrunc;
                }
                return description;
            },
            searchProduct(searchText, productList) {
                const searchTextLowerCase = searchText.toLowerCase();
                const results = productList.filter(product => {
                    let productNameLowerCase = product.title.toLowerCase();
                    for (let i = 0; i < searchTextLowerCase.length; i++) {
                    if (productNameLowerCase.includes(searchTextLowerCase[i])) {
                        productNameLowerCase = productNameLowerCase.slice(productNameLowerCase.indexOf(searchTextLowerCase[i]) + 1);
                    } else {
                        return false;
                    }
                    }
                    return true;
                });

                return results;
            },
            async getCategories()
            {
                try {
                    const data = await axios.get('/categories/' + this.id)
                    this.productList = data.data.products;
                } catch (error) {
                    await console.log(error)
                }
            }
        }
    }
</script>
