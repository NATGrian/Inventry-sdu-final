<template>
  <div class="container-fluid" id="createproduct-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/product/list">ผลิตภัณฑ์</BreadcrumbItem>
      <BreadcrumbItem>เพิ่มผลิตภัณฑ์ใหม่</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Form id="formcreate" ref="formcreatep" :model="formcreatep" :rules="ruleCustom">
      <Row type="flex" justify="space-around" align="middle">
        <Col span="15">
        <div class="Createfrom1-p">
          <Row>
            <Col span="24">
            <div class="title-from1">
              เพิ่มผลิตภัณฑ์ เข้าระบบครังแรก
            </div>
            </Col>
            <Col span="24" class="sub-title1">
            ช่องที่มี <span style="color: rgb(255, 0, 0);">*</span> เป็นช่องที่จำเป็นต้องกรอก
            </Col>

          </Row>
          <br>
          <Row type="flex" justify="space-between">
            <Col span="11" class="left-Formitem">
            <FormItem prop="Batch_no">
              <span slot="label" style="width: 10%;">เลขที่ครังที่ผลิต:</span>
              <Input type="text" element-id="formcreate-Batch_no" v-model="formcreatep.Batch_no" style="width: 55%;" placeholder="" size="small" />

            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="itemname">
              <span slot="label" style="width: 10%;">รายการ:</span>
              <Input type="text" element-id="formcreate-itemname" v-model="formcreatep.itemname" placeholder=""  style="width: 65%;" size="small" />

            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="12" class="left-Formitem">
            <FormItem prop="CID">
              <span slot="label" style="width: 10%;">ประเภทของสิ่งของ</span>
              <Select element-id="formcreate-categorys" v-model="formcreatep.CID" placeholder="ค้นหา ประเภท" style="width: 50%;" size="small">
                <Option v-for="c in categorys" :value="c.id" :key="c.id">{{ c.name }}</Option>
              </Select>

            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="qty">
              <span slot="label" style="width: 10%;">จำนวน:</span>
              <InputNumber element-id="formcreate-qty" size="small" v-model="formcreatep.qty" @on-blur="focusOut" controls-outside />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="11" class="left-Formitem">
            <FormItem prop="storageID" >
              <span slot="label">สถานที่จัดเก็บ</span>
              <Select element-id="formcreate-storage" v-model="formcreatep.storageID" placeholder="ค้นหา ที่เก็บ" style="width: 55%;" size="small">
                <Option v-for="s in storage" :value="s.id" :key="s.id">{{ s.name }}</Option>
              </Select>

            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="PID">
              <span slot="label" style="width: 10%;">ผู้ส่ง:</span>
              <Select element-id="formcreate-peoples" v-model="formcreatep.PID" placeholder="ค้นหา ผู้ผลิต/ผู้จัดจำหน่าย" style="width: 60%;" size="small">
                <Option v-for="p in peoples" :value="p.id" :key="p.id">{{ p.firstname }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>

          <Row type="flex" justify="space-between">
            <Col span="7" class="left-Formitem">
            <FormItem prop="MFG">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป ที่ผลิต (MFG.):</span>
              <DatePicker element-id="formcreate-MFG" v-model="formcreatep.MFG"  @on-change="(value) => this.formcreatep.MFG=value.toString()"  size="small" type="date" format="yyyy-MM-dd" placeholder="Select date" style="width: 80%;" />

            </FormItem>
            </Col>
            <Col span="7">
            <FormItem prop="EXP">
              <span slot="label" style="width: 10px;word-wrap: break-word;">ว-ด-ป หมดอายุ (EXP.):</span>
              <DatePicker element-id="formcreate-EXP" v-model="formcreatep.EXP"  @on-change="(value) => this.formcreatep.EXP=value.toString()"  size="small" type="date" format="yyyy-MM-dd"  placeholder="Select date" style="width: 80%;" />
            </FormItem>
            </Col>
            <Col span="7" class="right-Formitem">
            <FormItem prop="import_at">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป นำเข้า:</span>
              <DatePicker element-id="formcreate-import_at" v-model="formcreatep.import_at" @on-change="(value) => this.formcreatep.import_at=value.toString()" size="small" type="date" format="yyyy-MM-dd"  placeholder="Select date" style="width: 80%;" />
            </FormItem>
            </Col>
          </Row>
         
        </div>
        </Col>

        <Col span="7">
        <div class="Createfrom2-p">
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">รายละเอียดย่อย</span>
              <Input element-id="formcreate-description" v-model="formcreatep.description" :autosize="{minRows: 2,maxRows: 5}" type="textarea" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">รายละเอียดย่อย</span>
              <Input element-id="formcreate-UID" v-model="formcreatep.UID" readonly type="text" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <FormItem>
              <Row type="flex" justify="center">
                <Button type="primary" @click="handleSubmit" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มรายการ</Button>
                <Button @click="handleReset('formcreatep')" style="margin-left: 8px">Reset</Button>
              </Row>
            </FormItem>
            </Col>
          </Row>
        </div>
        </Col>
      </Row>
      <br>
    </Form>

  </div>
</template>

<script>
import { get, post, put } from "../../helpers/api";
export default {
  created() {
    get("/api-inv/users/" + localStorage.getItem("user_id")).then((res) => {
      this.users = res.data.user;
      this.formcreatep.UID = res.data.user.firstname;
      this.id = res.data.user.id;
    });
    get("/api-inv/peoples").then((res) => {
      this.peoples = res.data.peoples;
    });
    get("/api-inv/storages").then((res) => {
      this.storage = res.data.storages;
    });
    get("/api-inv/category-p").then((res) => {
      this.categorys = res.data.category;
    });
  },
  data() {
    return {
      id: "",
      users: [],
      peoples: [],
      storage: [],
      categorys: [],
      formcreatep: {
        Batch_no: '',
        UID: '',
        itemname: '',
        import_at: '',
        EXP: '',
        MFG: '',
        qty: 1,
        invoice_no: '',
        description: '.',
        PID: '',
        CID: '',
        storageID: '',
      },

      ruleCustom: {
        Batch_no: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        itemname: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        invoice_no: [
          {
            required: false,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        qty: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "change",
            type: "number",
          },
        ],
        MFG: [
          {
            required: true,
            type: "date",
            message: "กรุณา ตั้งค่าเวลา !!",
            trigger: "change",
          },
        ],
        EXP: [
          {
            required: true,
            type: "date",
            message: "กรุณา ตั้งค่าเวลา !!",
            trigger: "change",
          },
        ],
        import_at: [
          {
            required: true,
            type: "date",
            message: "กรุณา ตั้งค่าเวลา !!",
            trigger: "change",
          },
        ],
        PID: [
          {
            required: true,
            message: "กรุณาเลือก",
            trigger: "change",
            type: "number",
          },
        ],
        storageID: [
          {
            required: true,
            message: "กรุณาเลือก",
            trigger: "change",
            type: "number",
          },
        ],
        CID: [
          {
            required: true,
            message: "กรุณาเลือก",
            trigger: "change",
            type: "number",
          },
        ],
        description: [
          {
            required: false,
            message: "Please enter a personal introduction",
            trigger: "blur",
          },
          {
            type: "string",
            min: 20,
            message: "Introduce no less than 20 words",
            trigger: "blur",
          },
        ],
      },
    };
  },
  methods: {
    focusOut() {
        this.formcreatep.qty =  parseFloat(`${this.formcreatep.qty.toFixed(2)}`);
    },
    handleSubmit() {
      this.formcreatep.UID = this.id
      this.$Loading.start();
      post("/api-inv/products", this.formcreatep)
        .then((res) => {
          this.$Loading.finish();
          if (res.data.succeed) {
            this.$router.push("/product/list");
          }
          
        })
        .catch((err) => {
          this.$Loading.error();
          if (err.response.status === 422) {
            this.error = err.response.data;
            this.$Message.error("เกิดข้อผิดพลาด");
          }
        });
    },
    handleReset(name) {
      this.$refs[name].resetFields();
    },
  },
};
</script>


<style>
.Createfrom1-p {
  background-color: rgb(255, 255, 255);
  height: 400px;
}

.title-from1 {
  margin: 20px 0 0 40px;
  font-size: 15px;
  font-weight: bold;
  color: #000;
  text-shadow: 8px 4px 6px #959595a8;
}
.sub-title1 {
  margin-left: 50px;
  font-size: 10px;
}
.left-Formitem {
  padding-left: 30px;
}
.right-Formitem {
  padding-right: 30px;
}
.Createfrom2-p {
  background-color: rgb(255, 255, 255);
  height: 300px;
}

.ivu-form-item-error-tip {
  font-size: 10px;
}
.ivu-form-item {
  margin-bottom: 10px;
}

.ivu-divider-horizontal {
  margin: 10px 0;
}
.input-role {
  display: block;
  text-align: center;
}
</style>