<template>
    <div class="container mt-5">
      <h3 class="text-center " style="color:white"> <i>welcome {{ user }}</i> </h3>
      <p class="text-center " style="color:white"> <i><a :href="'/users/deleteprofile?id=' + id ">Delete</a>account</i> </p>
      <h1>{{ message }}</h1>
      <form>
        <div class="form-group">
          <label class="text-white" for="name">Name:</label>
          <input type="text" class="form-control color" id="name" v-model="name" >
        </div>
        <div class="form-group">
          <label class="text-white" for="email">Email:</label>
          <input type="email" class="form-control color " id="email" v-model="email">
        </div>
        <div class="form-group">
          <label class="text-white" for="programe">Programe:</label>
          <input type="text" class="form-control color" id="programe" v-model="programe">
        </div>
        <div class="form-group">
          <label class="text-white" for="programe">New Password:</label>
          <input type="text" class="form-control color " id="password" required v-model="password">
        </div>
        <div class="form-group">
          <label class="text-white" for="created">Created_at</label>
          <input type="created" class="form-control color " id="created" readonly v-model="createdat">
        </div>
        <div class="form-group">
          <label class="text-white" for="updated">updated_at</label>
          <input type="updated" class="form-control color" id="updated" readonly v-model="updatedat">
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="updateProfile">Update Profile</button>
      </form>
    </div>
  </template>
  
  <style>
   body {
                    background-image: url(' https://cdn.pixabay.com/photo/2016/05/12/16/35/earth-1388003_960_720.jpg');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center center;
                    

                }

                .color{
                  background-color: rgb(255, 255, 255);
                }

  </style>
  
   <script>

  
  export default {
    data() {
      return {
        user:'',
        id:'',
        name: '',
        email: '',
        programe:'',
        password:'',
        createdat:'',
        updatedat:'',
        message:''
      }
    },

    props: {
    Data: Object
    
  },
  mounted(){
   this.UserProfile();
   
  },
  methods:{
   async  UserProfile(){
        try {
            const response= await axios.get('getprofile/');
            const data=response.data;
            console.log(data);
              this.id=data.id;
                 this.user=data.name;
                this.name=data.name;
                this.email=data.email;
                this.programe=data.interests;
                this.createdat=data.created_at;
                this.updatedat=data.updated_at;
            
        } catch (error) {
            
        }
        
    },

   async updateProfile(){
        const response=await axios.get('updateprofile/',{ params: { id: this.id, name:this.name ,email:this.email, interests:this.programe,password:this.password} });
        const data=response.data;
        window.location.reload();
        
         
          

        
    }
  }
 

  }
  </script>