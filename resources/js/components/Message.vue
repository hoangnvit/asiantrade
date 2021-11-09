<template>
  <div>
    <div class="d-flex justify-content-center my-2">
      <ul class="list-inline">
        <li class="btn btn-primary list-inline-item" @click="getinbox">
          Inbox({{ num_inbox }})
        </li>
        <li class="btn btn-primary list-inline-item" @click="getoutbox">
          Outbox ({{ num_outbox }})
        </li>
        <li class="btn btn-primary list-inline-item" @click="sent_message">
          New Message
        </li>
      </ul>
    </div>

    <div v-if="display_messages == 1" class="row col-12 mx-auto border rounded">
      <div class="col-4 border border-primary overflow-auto text-break">
        <p v-if="ck_inbox == 1">
          <u>({{ unread }}) Unread</u>
        </p>
        <p v-if="ck_outbox == 1"><u>Messages sented:</u></p>

        <div
          v-for="(item, index) in list_messages"
          :key="index"
          v-bind:class="{
            'font-weight-bold': !item.read_status && ck_inbox == 1,
          }"
          @click="message_detail(item.id, $event)"
        >
          <p>{{ item.title }}</p>
          <hr />
        </div>
      </div>
      <div class="col-8 border border-primary">
        <div v-if="display_detail == 1">
          <h5 class="text-break">{{ title }}</h5>
          <hr />
          <p class="text-break">{{ message }}</p>
          <hr />
          <p>{{ sent_time }}</p>
          <p v-if="ck_inbox == 1">{{ sender }}</p>
          <p v-if="ck_outbox == 1">{{ receiver }}</p>

          <input
            class="btn btn-warning"
            value="Delete"
            @click="un_display(message_id_detail)"
          />
        </div>
      </div>
    </div>

    <div v-if="display_form == 1">
      <form class="m-2 p-2 border border-warning rounded">
        <label for="receiver">Choose an User:</label>

        <select v-model="receiver">
          <option
            v-for="(item, index) in list_users"
            :key="index"
            :value="item.id"
          >
            {{ item.username }}
          </option>
        </select>
        <br />
        <label for="message_title">Subject</label>
        <div class="form-group">
          <input type="text" v-model="message_title" class="form-control" />
        </div>
        <label for="message_body">Message</label>
        <div class="form-group">
          <textarea v-model="message_body" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <input class="btn btn-warning" value="Sent" @click="save_message" />
        </div>
        <p class="text-danger">{{ result_message }}</p>
      </form>
    </div>
  </div>
</template>

<script>
import Input from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Input.vue";
export default {
  components: { Input },
  props: [],
  data() {
    return {
      list_messages: {},
      title: "",
      message: "",
      display_form: 0,
      display_messages: 1,
      list_users: {},
      message_body: "",
      message_title: "",
      receiver: 1,
      ck_inbox: 0,
      ck_outbox: 0,
      sender: "",
      receiver: "",
      result_message: "",
      num_inbox: 0,
      num_outbox: 0,
      unread: 0,
      sent_time: "",
      display_detail: 0,
      message_id_detail: 0,
    };
  },
  mounted() {
    this.getinbox();
    this.get_in_out();
  },
  methods: {
    get_in_out() {
      axios.get("/user/messages/total").then((response) => {
        // console.log("total");
        //  console.log(response.data);
        this.num_inbox = response.data[0];
        this.num_outbox = response.data[1];
      });
    },
    setup() {
      this.display_form = 0;
      this.display_messages = 1;

      axios.get("/user/messages/inbox").then((response) => {
        // console.log("inbox");
        //  console.log(response.data);
        this.list_messages = response.data;
      });
      // this.getinbox();
    },
    getinbox() {
      this.display_form = 0;
      this.display_messages = 1;
      this.ck_inbox = 1;
      this.ck_outbox = 0;
//--------

      this.title="";
      this.message="";
      this.sender="";
      this.receiver="";

      this.get_unread();
      axios.get("/user/messages/inbox").then((response) => {
        this.list_messages = response.data;
        this.result_message = "";
      });
    },

    get_unread() {
      axios.get("/user/messages/unread").then((response) => {
        this.unread = response.data;
      });
    },
    getoutbox() {
      this.display_form = 0;
      this.display_messages = 1;
      this.ck_outbox = 1;
      this.ck_inbox = 0;
      //
      this.title="";
      this.message="";
      this.sender="";
      this.receiver="";

      axios.get("/user/messages/outbox").then((response) => {
        this.list_messages = response.data;
        this.result_message = "";
      });
    },
    message_detail(message_id) {
      this.display_detail = 1;

      axios.get("/user/messages/" + message_id + "/detail").then((response) => {
        this.title = response.data[0].title;
        this.message = response.data[0].message;
        this.sent_time = response.data[0].created_at;
        this.sender = "From: " + response.data[1];
        this.receiver = "To: " + response.data[2];
        this.message_id_detail = response.data[0].id;

        this.get_unread();
      });
    },

    sent_message() {
      this.display_form = 1;

      this.display_messages = 0;

      axios.get("/user/messages/users").then((response) => {
        this.list_users = response.data;
        this.result_message = "";
      });
    },

    save_message() {
      this.result_message = "";
      if (
        this.receiver == "" ||
        this.message_body == "" ||
        this.message_title == ""
      ) {
        this.result_message = "Please input info for all fields above";
      } else {
        axios
          .post("/user/messages/save", {
            message: this.message_body,
            receiver_id: this.receiver,
            title: this.message_title,
          })
          .then((response) => {
            console.log("message save");
            console.log(response.data);
            this.message_body = "";
            this.message_title = "";
            this.receiver = "";
            this.result_message = "Your message is sent!";
            this.get_in_out();
          });
      }
    },
    un_display(message_id) {
      console.log("undisplay" + message_id);
      axios
        .get("/user/messages/" + message_id + "/un_display")
        .then((response) => {
          console.log("respon" + response.data);
          let ck_box = response.data;

          this.message_body = "";
          this.message_title = "";
          this.receiver = "";
          this.display_detail = 0;
          if (ck_box == 1) this.getoutbox();
          else this.getinbox();
        });
    },
  },
};
</script>
