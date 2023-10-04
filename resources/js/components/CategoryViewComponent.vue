<template>
    <div style="display: flex; flex-direction:row; align-items:center; justify-content:center;">
        <div class="input-group mb-3" style="width: 60%;">
            <input type="text" class="form-control" placeholder="Type..." aria-label="Type..." aria-describedby="basic-addon2" v-model="searchText">
        </div>
    </div>
    <category-component :id="id" :name="name" :byName="searchText"></category-component>

</template>

<script>
    import CategoryComponent from './CategoryComponent.vue'
    export default {
        components:{
            CategoryComponent
        },
        props:[ "id" ],
        data(){
            return {
                searchText:"",
            }
        },
        mounted() {

        },

        methods:{

        }
    }
</script>
