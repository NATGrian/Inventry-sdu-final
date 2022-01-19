<template>
  <div class="container-fluid" id="users-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>เจ้าหน้าที่จัดการระบบ</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Button id="btn_addmember" type="primary" @click="addmember = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มเจ้าหน้าที่</Button>
      <Modal v-model="addmember" id="addmember" title="เพิ่มเจ้าหน้าที่ เข้าสู่ระบบ" @on-ok="addusers" @on-cancel="cancel" draggable reset-drag-position sticky :z-index="2000" width="700">
        <p slot="header" style="color:#0040FF;text-align:center">
          <Icon type="md-add"></Icon>
          <span>เพิ่มเจ้าหน้าที่ เข้าสู่ระบบ</span>
        </p>
        <Form ref="formcreateUser" :model="formcreateUser" :rules="ruleValidate" label-position="top">
          <Row type="flex" justify="space-between">
            <Col span="15">
            <Row type="flex" justify="center">
              <Col span="11" class="profile-input">
              <FormItem label="ชื่อจริง" prop="firstname">
                <Input element-id="formcreateUser-firstname" v-model="formcreateUser.firstname" prefix="ios-contact" style="width: auto" type="text" clearable />
              </FormItem>

              </Col>
              <br>
              <Col span="11" class="profile-input" offset="1">
              <FormItem label="นามสกุล" prop="lastname">
                <Input element-id="formcreateUser-lastname" v-model="formcreateUser.lastname" prefix="ios-contact" style="width: auto" type="text" clearable />
              </FormItem>

              </Col>
            </Row>
            <br>
            <Row type="flex" justify="center">
              <Col span="11" class="profile-input">
              <FormItem label="Email" prop="email">
                <Input element-id="formcreateUser-email" v-model="formcreateUser.email" prefix="ios-mail" style="width: auto" type="email" clearable />
              </FormItem>
              </Col>
              <br>
              <Col span="11" class="profile-input" offset="1">
              <FormItem label="เบอร์ติดต่อ" prop="phone">
                <Input element-id="formcreateUser-phone" v-model="formcreateUser.phone" prefix="md-closed-captioning" style="width: auto" type="tel" clearable />
              </FormItem>

              </Col>
            </Row>
            <br>
            <Row type="flex" justify="center">
              <Col span="11" class="profile-input">
              <FormItem label="รหัสผ่าน" prop="password">
                <Input element-id="formcreateUser-password" v-model="formcreateUser.password" prefix="ios-lock" style="width: auto" type="password" password />
              </FormItem>
              </Col>
              <br>

            </Row>
            </Col>

            <Col span="8">
            <Row type="flex" justify="center">
              <Col span="23">
              <div style="background-color: rgb(255, 255, 255);">
                <!-- <ImageModal v-model="formcreateUser.image"></ImageModal> -->
              </div>
              </Col>
            </Row>
            <Divider plain></Divider>
            <Row type="flex" justify="center">

              <Col :md="16" :sm="22" class="profile-input">
              <FormItem label="ตำแหน่ง" prop="name">
                <Select element-id="formcreateUser-role" v-model="formcreateUser.role_id" filterable>
                  <Option v-for="item in roledata" :value="item.id" :key="item.id">{{ item.role }}</Option>
                </Select>
              </FormItem>
              </Col>

            </Row>

            </Col>
          </Row>
        </Form>

        <div slot="footer" style="text-align:center">
          <Button icon="md-checkmark" size="large" style="color:#000;text-align:center border: #000 solid 2px; background-color: rgb(255, 255, 255);" @click="addusers">ยืนยันการเพิ่ม</Button>
        </div>
      </Modal>
      </Col>

      <Col>
      <Button id="btn_to-roles" type="primary" to="/member/roles" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มตำแหน่ง</Button>
      </Col>

      <Col span="9" offset="1">
      <Input element-id="search" search @on-search="tableItems" v-model="search" placeholder="ค้นหาชื่อที่ต้องการ" style="width: 350px" />
      </Col>

      <Col>
      <Tooltip content="export to PDF" placement="top">
        <Button id="btn_exportpdf" shape="circle" icon="md-archive" size="large" @click="exportpdf" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="export to csv" placement="top">
        <Button id="btn_exportcsv" shape="circle" icon="md-archive" size="large" @click="exportcsv" />
      </Tooltip>
      </Col>

    </Row>
    <br>
    <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true" :paginate-elements-by-height="1100" :filename="filename" :pdf-quality="2" :manual-pagination="false" pdf-format="letter" pdf-content-width="100%" pdf-orientation="landscape" @hasStartedGeneration="hasStartedGeneration()" @hasGenerated="hasGenerated($event)" ref="html2Pdf">
      <template slot="pdf-content">
        <Row type="flex" justify="center" align="middle">
          <Col>
          <h1>รายชื่อ เจ้าที่หน้าดูแลระบบ</h1>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="20">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมล์</th>
                <th>เบอร์โทร</th>
                <th>ตำแหน่ง</th>
                <th>วันที่ เพิ่มเข้าระบบ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>{{user.firstname}} {{user.lastname}}</td>
                <td>{{user.email}}</td>
                <td>{{user.phone}}</td>
                <td>{{user.role}}</td>
                <td>{{user.created_at}}</td>
              </tr>
            </tbody>
          </table>
          </Col>
        </Row>
        <Row type="flex" justify="end" class="code-row-bg">
          <Col>
          <Divider>
            <h6> {{filename}} </h6>
          </Divider>

          </Col>
        </Row>
      </template>
    </vue-html2pdf>
    <Row type="flex" justify="center">
      <Table size="small" :loading="loading" width="860" height="400" max-height="450" border ref="selection" :columns="columns" :data="users">
        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :total="1" size="small" show-elevator show-sizer />
        </template>
      </Table>

    </Row>
    <Modal id="modalshow" v-model="modalshow" title="ข้อมูล เจ้าหน้าที่ดูแลระบบ" footer-hide width="700" draggable>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="11">
        <p> <b style="color: #000;">ชื่อ - นามสกุล:</b> {{ showdata.firstname }} {{ showdata.lastname }} </p>
        <p> <b style="color: #000;">email:</b> {{ showdata.email }} </p>
        <p> <b style="color: #000;">เบอร์โทร:</b> {{ showdata.phone }} </p>
        <p> <b style="color: #000;">ตำแหน่ง:</b> {{ showdata.role }} </p>
        </Col>
        <Col span="11">
        <img :src="`/images/users/${showdata.image}`" alt="">
        </Col>
      </Row>

    </Modal>

    <Modal id="modalconfirm" v-model="modalConfirm" width="500" draggable @on-ok="confirm" @on-cancel="cancelcf">
      <p slot="header" style="color:#2E9AFE;text-align:center">
        <Icon type="md-help-circle" />
        <span style="color:#FF0000;">แน่ใจว่า ต้องการลบ</span>
      </p>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="10">
        <Icon type="ios-trash" size="35" color="#FF0040" /> <span style="color:#482728; font-size: 20px; text-align: center;">ยืนยัน กดตกลง</span>
        </Col>

      </Row>

    </Modal>
  </div>
</template>


<script>
import VueHtml2pdf from "vue-html2pdf";
import { get, post, del } from "../../helpers/api";

export default {
  components: {
    VueHtml2pdf,
  },
  props: {
    Zindex: {
      type: Number,
      default: 2000,
    },
  },
  data() {
    return {
      modalConfirm: false,
      filename: "",
      search: "",
      columns: [
        {
          title: "Name",
          key: "firstname",
          width: 200,
          align: "center",
          sortable: true,
        },
        {
          title: "Mail",
          key: "email",
          width: 250,
          align: "center",
        },
        {
          title: "เบอร์โทร",
          key: "phone",
          width: 120,
          align: "center",
        },
        {
          title: "ตำแหน่ง",
          key: "role",
          width: 130,
          align: "center",
        },
        {
          title: "ตัวเลือก",
          key: "action",
          fixed: "right",
          width: 150,
          align: "center",
          slot: "action",
        },
      ],
      ruleValidate: {
        firstname: [
          {
            required: true,
            message: "ลืมใส่ชื่อ!!",
            trigger: "blur",
          },
        ],
        lastname: [
          {
            required: true,
            message: "ลืมใส่นามสกุล",
            trigger: "blur",
          },
        ],
        email: [
          {
            required: true,
            message: "กรอก อีเมล์(ที่ใช้งานจริง)",
            trigger: "blur",
          },
          { type: "email", message: "อีเมล์ไม่ถูกต้อง", trigger: "blur" },
        ],
        phone: [
          {
            required: true,
            message: "กรอกเบอร์สำหรับติดต่อ",
            trigger: "blur",
          },
        ],
        password: [
          {
            required: true,
            message: "กรุณาตั้งรหัสผ่าน",
            trigger: "blur",
          },
          {
            type: "string",
            min: 6,
            message: "รหัสขั้นต่ำ 6 ตัวอีกษร",
            trigger: "blur",
          },
        ],

        role_id: [
          {
            required: true,
            message: "กรุณาเลือกตำแหน่ง",
            trigger: "change",
          },
        ],
      },
      loading: true,
      formcreateUser: {
        firstname: "",
        lastname: "",
        email: "",
        phone: "",
        password: "",
        role_id: null,
      },
      addmember: false,
      users: [],
      roledata: [],
      error: {},
      showdata: {
        firstname: "",
        role: "",
        image: "",
        email: "",
        phone: "",
        lastname: "",
      },
      modalshow: false,
      deletingIndex: "",
      deletingID: "",
    };
  },
  methods: {
    timestamp() {
      const today = new Date();
      const date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
      const time =
        today.getHours() + "." + today.getMinutes() + "." + today.getSeconds();
      const timestamps = "เจ้าหน้าที่ดูแลระบบ " + date + " " + time;
      this.filename = timestamps;
    },
    tableItems(value) {
      const data = this.users;
      if (value.length > 0) {
        if (data.filter((users) => users.firstname === this.search)) {
          this.users = data.filter(
            (users) =>
              users.firstname.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
        } else {
          this.getusers();
        }
      } else {
        this.getusers();
      }
    },

    exportcsv() {
      this.$refs.selection.exportCsv({
        filename: this.filename,
      });
    },
    exportpdf() {
      this.$refs.html2Pdf.generatePdf();
    },
    addusers() {
      this.$Loading.start();

      post("api-inv/users", this.formcreateUser)
        .then((res) => {
          this.$Loading.finish();
          if (res.data.registered) {
            this.addmember = false;
            this.users.unshift(res.data.user);
            this.$forceUpdate();
          }

          this.$Message.info("สำเร็จ");
        })
        .catch((err) => {
          this.$Loading.error();
          if (err.response.status === 422) {
            this.error = err.response.data;
            this.$Message.error("เกิดข้อผิดพลาด");
          }
        });
    },

    cancel() {
      this.$refs.formcreateUser.resetFields();
      this.$Message.info("ยกเลิกแล้ว");
    },
    show(index) {
      this.modalshow = true;
      this.showdata.firstname = this.users[index].firstname;
      this.showdata.lastname = this.users[index].lastname;
      this.showdata.phone = this.users[index].phone;
      this.showdata.email = this.users[index].email;
      this.showdata.image = this.users[index].image;
      this.showdata.role = this.users[index].role;
    },
    confirm() {
      del("api-inv/users/" + this.deletingID).then((res) => {
        this.$Loading.finish();
        this.users.splice(this.deletingIndex, 1);
        if (res.data.DELETE) {
          this.modalConfirm = false;
        }
        this.$Message.info("สำเร็จ");
      });
    },
    cancelcf() {
      this.modalConfirm = false;
    },
    remove(index) {
      this.deletingIndex = index;
      this.deletingID = this.users[index].id;
      this.modalConfirm = true;
    },
    getusers() {
      get("/api-inv/users").then((res) => {
        this.users = res.data.users;
        this.loading = false;
      });
    },
    getroles() {
      get("/api-inv/roles").then((res) => {
        this.roledata = res.data.roles;
        this.loading = false;
      });
    },
  },

  created() {
    this.getusers();
    this.getroles();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
.ivu-table td {
  font-family: helvetica, Arial, sans-serif;
}
.ivu-table th {
  font-family: helvetica, Arial, sans-serif;
}
</style>

