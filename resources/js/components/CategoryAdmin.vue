<template>
	<div class="row justify-content-center align-items-center" style="padding-top:20px; padding-left:10px;">

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
                    <th>CREATE</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>#</td>
					<td><input id="mname"  type="text"  ></td>
					<td> <button @click="createCategory" type="button" class="btn btn-warning">Create</button> </td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered">
			<thead>
                <tr>
					<th>ID</th>
					<th>NAME</th>
					<th>OPTIONS</th>
				</tr>
			</thead>
			<tbody v-for="category,i in categoryList" :key="i">
                <tr>
					<td>{{category.id}}</td>
					<td><input :id="'mname'+i"  type="text" :value="category.name"></td>
					<td style="display: flex; gap:10px;">
                        <button @click="modifyCategory(category.id,i)" type="button" class="btn btn-warning">Modify</button>
                        <button @click="removeCategory(category.id)" type="button" class="btn btn-danger">Delete</button>
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
				categoryList: [],
			};
		},
		mounted() {
			this.getCategories();
		},
		methods: {
			async getCategories() {
				try {
					const data = await axios.get("/categories");
					this.categoryList = data.data;
					console.log(this.categoryList);
				} catch (error) {
					await console.log(error);
				}
			},
			async createCategory(i) {
				try {
					let mname = document.getElementById("mname").value;

					const data = await axios.post("/categories", {
						name: mname,
					});
					alert("category has been created :)");
				} catch (error) {
					await console.log(error);
					alert("Error creating category  :(");
				}
			},
			async modifyCategory(pid, i) {
				try {
                    let mname = document.getElementById("mname"+i).value;
					const data = await axios.put("/categories", {
                        id:pid,
						name: mname,
					});

					alert("category modification has been apply");
				} catch (error) {
					alert("Error category modification applying");
					await console.log(error);
				}
			},
			async removeCategory(i) {
				try {
					const data = await axios.delete("/categories/" + i);
					alert("category has been deleted");
					window.location.reload();
				} catch (error) {
					alert("Error category deleting");
					await console.log(error);
				}
			},
		},
	};
</script>
