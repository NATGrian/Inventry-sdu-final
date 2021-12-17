<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem>เจ้าหน้าที่จัดการระบบ</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Button type="primary" @click="addmember = true" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มเจ้าหน้าที่</Button>
      <Modal v-model="addmember" title="เพิ่มเจ้าหน้าที่ เข้าสู่ระบบ" @on-ok="addusers" @on-cancel="cancel" draggable reset-drag-position sticky :z-index="zindex" width="auto">
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
                <Input v-model="formcreateUser.firstname" prefix="ios-contact" style="width: auto" type="text" clearable />
              </FormItem>

              </Col>
              <br>
              <Col span="11" class="profile-input" offset="1">
              <FormItem label="นามสกุล" prop="lastname">
                <Input v-model="formcreateUser.lastname" prefix="ios-contact" style="width: auto" type="text" clearable />
              </FormItem>

              </Col>
            </Row>
            <br>
            <Row type="flex" justify="center">
              <Col span="11" class="profile-input">
              <FormItem label="Email" prop="email">
                <Input v-model="formcreateUser.email" prefix="ios-mail" style="width: auto" type="email" clearable />
              </FormItem>
              </Col>
              <br>
              <Col span="11" class="profile-input" offset="1">
              <FormItem label="เบอร์ติดต่อ" prop="phone">
                <Input v-model="formcreateUser.phone" prefix="md-closed-captioning" style="width: auto" type="tel" clearable />
              </FormItem>

              </Col>
            </Row>
            <br>
            <Row type="flex" justify="center">
              <Col span="11" class="profile-input">
              <FormItem label="รหัสผ่าน" prop="password">
                <Input v-model="formcreateUser.password" prefix="ios-lock" style="width: auto" type="password" password />
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
                <Select v-model="formcreateUser.role_id" filterable>
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
      <Button type="primary" to="/member/roles" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มตำแหน่ง</Button>

      </Col>

      <Col span="9" offset="1">
      <Input search placeholder="Enter something..." style="width: 350px" />
      </Col>

      <Col>
      <Tooltip content="export to PDF" placement="top">
        <Button shape="circle" icon="md-archive" size="large" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="export to csv" placement="top">
        <Button shape="circle" icon="md-archive" size="large" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="สั่งปลิ้น" placement="top">
        <Button shape="circle" icon="md-print" size="large" />
      </Tooltip>
      </Col>

      <Col>
      <Tooltip content="ลบตาราง" placement="top">
        <Button shape="circle" icon="md-trash" size="large" />
      </Tooltip>
      </Col>
    </Row>
    <br>
    <Row type="flex" justify="center">
      <Table size="small" :loading="loading" width="872" height="400" max-height="450" border ref="selection" :columns="columns" :data="users">
        <template slot-scope="{ row,index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(row, index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :total="40" size="small" show-elevator show-sizer />
        </template>
      </Table>

    </Row>

  </div>
</template>


<script>
import ImageModal from "../../components/Members/ImageUpload-u.vue";
import { get, post, put } from "../../helpers/api";
export default {
  components: {
    ImageModal,
  },
  props: {
    zIndex: {
      type: Number,
    },
  },
  data() {
    return {
      loading: true,
      zindex: 2000,
      formcreateUser: {
        firstname: "",
        lastname: "",
        email: "",
        phone: "",
        password: "",
        // image: '',
        role_id: null,
      },
      isAdding: false,
      addmember: false,
      columns: [
        {
          type: "selection",
          width: 50,
          align: "center",
        },
        {
          title: "Name",
          key: "firstname",
          width: 200,
          align: "center",
          sortable: true,
          // slot: "name",
        },
        {
          title: "Mail",
          key: "email",
          width: 219,
          align: "center",
          // slot: "email",
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
      users: [],
      roledata: [],
      editIndex: -1,
      error: {},
    };
  },
  methods: {
    addusers() {
      this.$Loading.start();
      post("api/users", this.formcreateUser)
        .then((res) => {
          this.$Loading.finish();
          if (res.data.registered) {
            this.addmember = false;
            this.users.unshift(res.data.user);
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
      this.formcreateUser.firstname = "";
      this.formcreateUser.lastname = "";
      this.formcreateUser.email = "";
      this.formcreateUser.phone = "";
      this.formcreateUser.password = "";
      this.formcreateUser.role_id = null;
      this.$Message.info("ยกเลิกแล้ว");
    },
    show(index) {
      this.$Modal.info({
        title: "User Info",
        content: `Name：${this.users[index].name}<br>Age：${this.users[index].age}<br>Address：${this.users[index].address}`,
      });
    },
    remove(index) {
      this.users.splice(index, 1);
    },
  },

  created() {
    get("/api/users").then((res) => {
      this.users = res.data.users;
      this.loading = false;
    });
    get("/api/roles").then((res) => {
      this.roledata = res.data.roles;
      this.loading = false;
    });
  },
};
</script>

<style>
.demo-upload-list {
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  text-align: center;
  line-height: 60px;
  border: 1px solid transparent;
  border-radius: 4px;
  overflow: hidden;
  background: rgb(123, 123, 123);
  position: relative;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  margin-top: 3px;
}
.demo-upload-list img {
  width: 100%;
  height: 100%;
}
.demo-upload-list-cover {
  display: none;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.6);
}
.demo-upload-list:hover .demo-upload-list-cover {
  display: block;
}
.demo-upload-list-cover i {
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  margin: 0 2px;
}
</style>

