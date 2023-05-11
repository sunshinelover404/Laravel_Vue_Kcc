<script>
import Footer from "./Footer.vue";
import About from "./About.vue";
export default {
  components: {
    Footer,
    About,
  },
  data() {
    return {
      keyword: null,
      Data: [],
      id: null,
      Display: '',
      hidden: 'none',
      Results: [],
      AskedResults: [],
      askeddisplay: 'none'
    };
  },

  props: {
    questions: Object,
    userasked: Object
  },


  watch: {

    keyword(after, before) {

      this.getResults();

    }
  },

  methods: {
    async getResults() {
      try {
        const response = await axios.get('/livesearch', { params: { keyword: this.keyword } })
        if (response.data == 'block') {

          this.Display = response.data;
          this.hidden = 'none';
        }
        else {
          const display = response.data[0];
          const results = response.data[1];

          if (results == 0) {

            this.Display = 'block';
            this.hidden = 'none';
          }
          else {

            this.hidden = 'block';
            this.Results = results;
            this.Display = display;

          }


        }

      } catch (error) {

      }
    },


    async getaskedanswer(id) {
      try {
        this.id = id;
        const response = await axios.get('/items/' + this.id)
        this.AskedResults = response.data;
        this.askeddisplay = 'block';
        console.log(this.AskedResults);

      } catch (error) {

      }

    },

    like(qid,quser) {
      axios.post('/like', {
        q_id: qid,
        q_user:quser
       
      })
      .then(response => {
        console.log(response)
      })
      .catch(error => {
        console.log(error)
      })
    },

   dislike() {
      axios.post('/dislike', {
        item_id: this.item.id,
        user_id: this.user.id
      })
      .then(response => {
        console.log(response)
      })
      .catch(error => {
        console.log(error)
      })
    }
  
  }


};

</script>
  





 

<template>
  <!-- <ul style="list-style-type: none">
    <li v-for="question in questions" :key="question">
      <div
        class="container bg-danger"
        style="height: 200px; border: 2px solid white"
      >
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <a href="" style="background-color: white">
              <h1>{{ question.q_title }}</h1>
            </a>
          </div>
        </div>
      </div>
    </li>
  </ul> -->
  <!-- <li v-for="(question) in questions" :key="question">
       {{ question.q_title }}
      </li> -->


  <div style="position: sticky; top: 0px">
    <div class="container-fluid " style="background-color:aliceblue;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <form action="" class="">
              <input type="search" style="width: 70%; height: 40px" v-model="keyword" required />
              <button type="submit" style="height: 40px"><i class="bi bi-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <span class="bg-white">{{ indicator }}</span>
    <div class="container-fluid">
      <div class="row">
        <div class="col-6 bg-warning shadow m-0 p-0">
          <div class="dropdown">
            <button class="dropbtn bg-success"><i class="bg-success bi bi-house "></i></button>
            <div class="dropdown-content" style="height:100px; width:300px">
              <a style="
                  background-color: lightseagreen;
                  border: 0.5px solid white;
                 font-family: serif;
                  font-size: 20px;
                  font-style: italic;
                  text-decoration-line: underline;
                  color:white;
                " href="/users/userprofile">Manage Profile</a>
              <a style="
                   background-color: lightseagreen;
                  border: 0.5px solid white;
                 font-family: serif;
                  font-size: 20px;
                  font-style: italic;
                  color:white;
                  text-decoration-line: underline;
                " href="/logout">Log Out</a>
            </div>
          </div>
        </div>
        <div class="col-6 bg-warning d-flex justify-content-end align-items-end">
          <div>
            <p>
              <a href="#" style="text-decoration: none; color: white">Ask <i class="bi bi-plus-circle-fill"></i></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- spacer -->
  <div class="container-fluid " style="height: 20px; background-color: gainsboro;"></div>




  <div class="overflow-auto" style="height: 700px; width: 100%; background-color: whitesmoke ; "
    v-bind:style="{ display: hidden }">
    <ul style="list-style-type: none;" v-for="result in Results" :key="result">
      <li>
        <div class="container" style="height: 200px; border: 20px solid gainsboro;background-color: whitesmoke;">
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <a class="text-decoration-none" href="#" style="background-color: white">
                <h3 class="text-decoration-none">
                  {{ result.q_title }}
                </h3>
              </a>

            </div>
            <div v-html="result.a_description" class="bg-white d-flex justify-content-center"
              style="height:90px; overflow:scroll;">

            </div>
            <div class="bg-white d-flex justify-content-center" style="height:50px; ">
              <p style="margin:2px; padding:2px;">created at:{{ result.created_at }}</p>
              <p style="margin:2px; padding:2px;">{{ result.q_programe }}</p>
              <p style="margin:2px; padding:2px;">email:{{ result.q_email }}</p>
              <p style="margin:2px; padding:2px;">updated at:{{ result.updated_at }}</p>
            </div>

          </div>
        </div>
      </li>
    </ul>
  </div>







  <div style="height:200px; background-color:blue; display:none">

  </div>

  <div class="container-fluid" v-bind:style="{ display: Display }">
    <div class="row">
      <div class="col-9 m-0 p-0" style="border:10px solid gainsboro;">

        <!-- We will apply display property here to hide and show the section -->
        <div class="overflow-auto" style="height: 700px; width: 100%; background-color: white; ">
          <ul style="list-style-type: none;">
            <li v-for="question in questions" :key="question">
              <div class="container" style="height: 200px; border: 20px solid gainsboro;background-color: whitesmoke;">
                <div class="row">
                  <div class="col-12 d-flex justify-content-center">
                    <a class="text-decoration-none" :href="'/users/questiondetail?id=' + question.id"
                      style="background-color: white">
                      <h3 class="text-decoration-none">
                        {{ question.q_title }}
                      </h3>


                    </a>

                  </div>
                  <div v-html="question.q_description" class="bg-white d-flex justify-content-center"
                    style="height:90px; overflow:scroll;">

                  </div>
                  <div class="bg-white d-flex justify-content-center" style="height:50px; "> 
                    <p style="margin:2px; padding:2px;">created at:{{ question.created_at }}</p>
                    <p style="margin:2px; padding:2px;">{{ question.q_programe }}</p>
                    <p style="margin:2px; padding:2px;">email:{{ question.q_email }}</p>
                    <p style="margin:2px; padding:2px;">updated at:{{ question.updated_at }}</p>
                    <span>
                      <a href="" v-on:click.prevent="like(question.id,question.q_user) " class="material-symbols-outlined"> thumb_up</a>
                      <a href="" class="material-symbols-outlined"> thumb_down</a>
                    </span>
                  </div>

                </div>
              </div>
            </li>
          </ul> 
        </div>
      </div>
      <div class="col-3 overflow-auto hidden"
        style="height: 700px; background-color: whitesmoke; border: 10px solid white;">
        <div class="row d-flex justify-content-end">
          <div class="col-12 bg-warning d-flex justify-content-center" style="width: 100%; height: 80px">
            <div>
              <h5 style="color: white">Want To Ask Question?</h5>
              <p class="d-flex justify-content-center" style="
                  color: white;
                  font-family: sans-serif;
                  font-style: italic;
                  font-size: 14px;
                "> 
                Pick The Category Place The Question!
              </p>
            </div>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <!-- <a :href="'/checkout?id='+id+'&name='+name+'&address='+address">Checkout</a> -->
            <a :href="'/users/createask?cat=' + 'Swen'" style="text-decoration: none; color: white">Software
              Engineering</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px; 
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Cpen'" style="text-decoration: none; color: white"> Computer
              Engineering</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Ai'" style="text-decoration: none; color: white"> Artificial
              Intelligence</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center 
              align-items-center" style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Ml'" style="text-decoration: none; color: white"> Machine Learning</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'faculty'" style="text-decoration: none; color: white"> Faculty
              Section</a>
          </div>
          <div class=" 
              col-12  
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Civil'" style="text-decoration: none; color: white"> Civil
              Engineering</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Mechanical'" style="text-decoration: none; color: white"> Mechanical
              Engineering</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Electrical'" style="text-decoration: none; color: white"> Electrical
              Engineering</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Cosc'" style="text-decoration: none; color: white"> Computer
              Science</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a href="" style="text-decoration: none; color: white"> Information Technology</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Cbs'" style="text-decoration: none; color: white"> Cyber Security</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'Cpen'" style="text-decoration: none; color: white"> Mathematics</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a :href="'/users/createask?cat=' + 'General Topics'" style="text-decoration: none; color: white"> General
              Topics</a>
          </div>
          <div class="
              col-12
              bg-success
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white; 
            ">
            <a href="" style="text-decoration: none; color: white"> Admin Related</a>
          </div>
          <div class="
              col-12
              bg-success 
              d-flex
              justify-content-center
              align-items-center
            " style="
              width: 90%;
              height: 40px;
              border-radius: 5px 0px 0px 50px;
              border: 0.5px solid white;
            ">
            <a href="" style="text-decoration: none; color: white"> Find More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Asked Question Section -->

  <div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center" style="height: 30px; background-color: ">
        <h3 class="glow">You Asked For</h3>
      </div>
      <div class="col-12">
        <table>
          <tbody>

            <tr>
              <td>
                <li v-for="userasked in userasked" style="list-style-type:none; ">
                  <button class="bg-success" href="" v-on:click="getaskedanswer(userasked.id)">{{ userasked.q_title }}
                  </button>
                </li>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Asked Question Section -->

  <div class="overflow-auto" style="height: 500px; width: 100%; background-color: whitesmoke ; "
    v-bind:style="{ display: askeddisplay }">
    <ul style="list-style-type: none;" v-for="AskedResults in AskedResults" :key="AskedResults">
      <li>
        <div class="container" style="height: 200px; border: 20px solid gainsboro;background-color: whitesmoke;">
          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <a class="text-decoration-none" href="#" style="background-color: white">
                <h3 class="text-decoration-none">
                  {{ AskedResults.q_title }}
                </h3>


              </a>

            </div>
            <div v-html="AskedResults.a_description" class="bg-white d-flex justify-content-center"
              style="height:90px; overflow:scroll;">

            </div>
            <div class="bg-white d-flex justify-content-center" style="height:50px; ">
              <p style="margin:2px; padding:2px;">created at:{{ AskedResults.created_at }}</p>
              <p style="margin:2px; padding:2px;">{{ AskedResults.a_programe }}</p>
              <p style="margin:2px; padding:2px;">email:{{ AskedResults.a_email }}</p>
              <p style="margin:2px; padding:2px;">updated at:{{ AskedResults.updated_at }}</p>
              <span>
                <a href="" class="material-symbols-outlined"> thumb_down</a>
                <a href="" class="material-symbols-outlined"> thumb_up</a>
              </span>
            </div>

          </div>
        </div>
      </li>
    </ul>
  </div>

  <Footer></Footer>
</template>





<style>
.material-symbols-outlined {
  font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 48
}



.dropbtn {
  color: white;
  padding: 12px;
  font-size: 16px;
  border: 1px solid rgb(252, 82, 82);
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;


}


body {
  background-color: black;

}

.glow {
  font-size: 50px;
  color: #fff;
  text-align: center;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }

  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
}
</style>