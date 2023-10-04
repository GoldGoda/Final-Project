<template>
    <div class="row justify-content-center align-items-center" style="padding-top:20px; padding-left:10px;">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PHOTO</th>
                        <th>NAME</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                        <th>CREATE</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>

                    </tr>
                    <tr>
                        <td>#</td>
                        <td><button type="button" class="btn btn-warning" @click="uploadFile">UPLOAD IMG</button></td>
                        <input type="file" id="userImg" name="userImg" accept="image/*" style="display: none;" onchange="" ref="userImg">
                        <td><input id="mname" type="text"  :v-model="newUser.name" ></td>
                        <td><input id="mphone" type="text" :v-model="newUser.phone"></td>
                        <td><input id="memail" type="text" :v-model="newUser.email"></td>
                        <td><input id="mpwd" type="password" :v-model="newUser.password"></td>
                        <td> <button @click="createUser" type="button" class="btn btn-warning">Create</button> </td>
                    </tr>
                </tbody>
                </table>

                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PHOTO</th>
                        <th>NAME</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>
                        <th>OPTIONS</th>

                    </tr>
                </thead>
                <tbody v-for="user,i in users.users" :key="i">
                    <tr>
                        <td>{{user.id}}</td>
                        <td><img width="60" :src="user.photo" alt="" srcset=""></td>
                        <td><input :id=" 'mname' + i " type="text" :value="user.name"></td>
                        <td><input :id=" 'mphone' + i " type="text" :value="user.phone"></td>
                        <td><input :id=" 'memail' + i " type="text" :value="user.email"></td>
                        <td style="display: flex; gap:10px;">
                            <button @click="modifyUser(user.id,i)" type="button" class="btn btn-warning">Modify</button>
                            <button @click="removeUser(user.id)" type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</template>

<script>
    export default {
        components:{

        },
        data(){
            return {
                newUser:{
                    name:"",
                    phone:"",
                    email:"",
                },
                users:[
                ]
            }
        },
        mounted() {
            this.getUsers();

        },
        methods:{

            async getUsers()
            {
                try {
                    const data = await axios.get('/users')
                    this.users = data.data;
                    console.log(this.users);
                } catch (error) {
                    await console.log(error)
                }
            },
            uploadFile(){
                document.getElementById('userImg').click();
            }
            ,
            async createUser(i)
            {
                try {
                    let name  = document.getElementById("mname").value;
                    let phone = document.getElementById("mphone").value;
                    let email = document.getElementById("memail").value;
                    let pwd = document.getElementById("mpwd").value;
                    const formData = new FormData();
                    formData.append('name' , name);
                    formData.append('phone', phone);
                    formData.append('email', email);
                    formData.append('pwd'  , pwd);
                    formData.append('file', this.$refs.userImg.files[0]);

                    const data = await axios.post('/users', formData, {
                        headers: {  'Content-Type': 'multipart/form-data'   }
                    });
                    alert("User has been created :)");
                } catch (error) {
                    await console.log(error)
                    alert("Error creating user :)");
                }
            },
            async modifyUser(ui, i)
            {
                try {
                    let name  = document.getElementById("mname"+i).value;
                    let phone = document.getElementById("mphone"+i).value;
                    let email = document.getElementById("memail"+i).value;

                    const data = await axios.put('/users', {
                        id:ui,
                        name:name,
                        phone:phone,
                        email:email
                    })
                    alert("User modification has been apply");
                } catch (error) {
                    alert("Error user modification applying");
                    await console.log(error)
                }
            },
            async removeUser(i)
            {
                try {
                    const data = await axios.delete('/users/' + i)
                    alert("User has been deleted");
                    window.location.reload();
                } catch (error) {
                    alert("Error user deleting");
                    await console.log(error)
                }
            },

        }
    }
</script>
