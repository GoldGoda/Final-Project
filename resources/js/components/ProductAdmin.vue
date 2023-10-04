<template>
	<div class="row justify-content-center align-items-center" style="padding-top:20px; padding-left:10px;">

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>IMAGE</th>
					<th>TITLE</th>
					<th>DESCRIPTION</th>
                    <th>PRICE</th>
					<th>STOCK</th>
					<th>CATEGORY</th>
					<th>CREATE</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>#</td>
					<td><button type="button" class="btn btn-warning">UPLOAD IMG</button></td>
					<td><input id="mname"  type="text"  ></td>
					<td><input id="mdescription" type="text" ></td>
					<td><input id="mprice" type="text" ></td>
					<td><input id="mstock" type="text" ></td>
					<td><input id="mcategory" type="text" ></td>
					<td> <button @click="createProduct" type="button" class="btn btn-warning">Create</button> </td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered">
			<thead>
                <tr>
					<th>ID</th>
					<th>IMAGE</th>
					<th>TITLE</th>
					<th>DESCRIPTION</th>
					<th>PRICE</th>
					<th>STOCK</th>
					<th>CATEGORY</th>
					<th>OPTIONS</th>
				</tr>
			</thead>
			<tbody v-for="product,i in productList" :key="i">
                <tr>
					<td>{{product.id}}</td>
					<td><img width="80" :src="product.img" alt="" srcset=""></td>
					<td><input :id="'mname'+i"  type="text" :value="product.name"></td>
					<td><input :id="'mdescription'+i" type="text" :value="product.description"></td>
					<td><input :id="'mprice'+i" type="text" :value="product.price"></td>
					<td><input :id="'mstock'+i" type="text" :value="product.stock"></td>
					<td><input :id="'mcategory'+i" type="text" :value="product.category_id"></td>
					<td style="display: flex; gap:10px;">
                        <button @click="modifyProduct(product.id,i)" type="button" class="btn btn-warning">Modify</button>
                        <button @click="removeProduct(product.id)" type="button" class="btn btn-danger">Delete</button>
                    </td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				newProduct: {
					img: "",
					title: "",
					stock: "",
					price: "",
					description: "",
					category: "",
				},
				productList: [],
			};
		},
		mounted() {
			this.getProducts();
		},
		methods: {
			async getProducts() {
				try {
					const data = await axios.get("/products");
					this.productList = data.data;
					console.log(this.productList);
				} catch (error) {
					await console.log(error);
				}
			},
			async createProduct(i) {
				try {
					let mname = document.getElementById("mname").value;
					let mdescription = document.getElementById("mdescription").value;
					let mprice = document.getElementById("mprice").value;
					let mstock = document.getElementById("mstock").value;
					let mcategory = document.getElementById("mcategory").value;

					const data = await axios.post("/products", {
						img: "https://salamadlc.com/wp-content/uploads/2022/03/121.png",
						name: mname,
						description: mdescription,
						price: mprice,
						stock: mstock,
						category_id: mcategory,
					});
					alert("Product has been created :)");
				} catch (error) {
					await console.log(error);
					alert("Error Product user :)");
				}
			},
			async modifyProduct(pid, i) {
				try {
                    let mname = document.getElementById("mname"+i).value;
					let mdescription = document.getElementById("mdescription"+i).value;
					let mprice = document.getElementById("mprice"+i).value;
					let mstock = document.getElementById("mstock"+i).value;
					let mcategory = document.getElementById("mcategory"+i).value;
					const data = await axios.put("/products", {
                        id:pid,
						name: mname,
						description: mdescription,
						price: parseInt(mprice),
						stock: parseInt(mstock),
						category_id: parseInt(mcategory),
					});

					alert("Product modification has been apply");
				} catch (error) {
					alert("Error Product modification applying");
					await console.log(error);
				}
			},
			async removeProduct(i) {
				try {
					const data = await axios.delete("/products/" + i);
					alert("Product has been deleted");
					window.location.reload();
				} catch (error) {
					alert("Error Product deleting");
					await console.log(error);
				}
			},
		},
	};
</script>
