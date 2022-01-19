<template>
  <div class="container-fluid" id="importproduct-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/product/list">ผลิตภัณฑ์</BreadcrumbItem>
      <BreadcrumbItem>บันทึกการนำเข้าผลิตภัณฑ์</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Form id="formimport" ref="formimportp" :model="formimportp" :rules="ruleCustom">
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
            <FormItem prop="Batch_no" >
              <span slot="label" style="width: 10%;">เลขที่ครังที่ผลิต:</span>
              <Input type="text" element-id="formimport-Batch_no" v-model="formimportp.Batch_no" style="width: 50%;" placeholder="" size="small" />

            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="itemname">
              <span slot="label" style="width: 10%;">รายการ:</span>
              <Select element-id="formimport-itemname" v-model="formimportp.itemname" @on-select="select" placeholder="ค้นหา ผลิตภัณฑ์" style="width: 50%;" size="small" filterable>
                <Option v-for="i in itempro" :value="i.id" :key="i.id">{{ i.itemname }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="11" class="left-Formitem">
            <FormItem prop="import_at" >
              <span slot="label" style="word-wrap: break-word;">ว-ด-ป นำเข้า:</span>
              <DatePicker element-id="formimport-import_at" v-model="formimportp.import_at" @on-change="(value) => this.formimportp.import_at=value.toString()" size="small" type="date" placeholder="Select date" style="width: 50%;" />
            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="qty_charge">
              <span slot="label" style="width: 10%;">จำนวน:</span>
              <InputNumber element-id="formimport-qty_charge" size="small" v-model="formimportp.qty_charge" @on-change="focusOut" controls-outside />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="11" class="left-Formitem">
            <FormItem prop="storageID">
              <span slot="label">สถานที่จัดเก็บ</span>
              <Select element-id="formimport-storage" v-model="formimportp.storageID" placeholder="ค้นหา ที่เก็บ" style="width: 50%;" size="small">
                <Option v-for="s in storage" :value="s.id" :key="s.id">{{ s.name }}</Option>
              </Select>

            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="PID">
              <span slot="label" style="width: 10%;">ผู้ส่ง:</span>
              <Select element-id="formimport-PID" v-model="formimportp.PID" placeholder="ค้นหา ผู้ผลิต/ผู้จัดจำหน่าย" style="width: 45%;" size="small">
                <Option v-for="p in peoples" :value="p.id" :key="p.id">{{ p.firstname }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>

          <Row type="flex" justify="space-around">
            <Col span="11" class="left-Formitem">
            <FormItem prop="MFG">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป ที่ผลิต (FG.):</span>
              <DatePicker element-id="formimport-MFG" v-model="formimportp.MFG" size="small" @on-change="(value) => this.formimportp.MFG=value.toString()" type="date" placeholder="Select date" style="width: 90%;" />

            </FormItem>
            </Col>
            <Col span="11" class="right-Formitem">
            <FormItem prop="EXP">
              <span slot="label" style="width: 10px;word-wrap: break-word;">ว-ด-ป หมดอายุ (EXP.):</span>
              <DatePicker element-id="formimport-EXP" v-model="formimportp.EXP" size="small" @on-change="(value) => this.formimportp.EXP=value.toString()" type="date" placeholder="Select date" style="width: 90%;" />
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
              <Input element-id="formimport-description" v-model="formimportp.description" :autosize="{minRows: 2,maxRows: 5}" type="textarea" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">ผู้ตรวจรับ</span>
              <Input v-model="formimportp.UID" readonly type="text" size="small" style="width: auto; display: inline-block;" />
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
      this.formimportp.UID = res.data.user.firstname;
      this.id = res.data.user.id;
    });
    get("/api-inv/peoples").then((res) => {
      this.peoples = res.data.peoples;
    });
    get("/api-inv/storages").then((res) => {
      this.storage = res.data.storages;
    });
    get("/api-inv/products").then((res) => {
      this.itempro = res.data.list;
    });
  },
  data() {
    return {
      id: "",
      itempro: [],
      users: [],
      peoples: [],
      storage: [],
      formimportp: {
        Batch_no: '',
        UID: '',
        itemname: '',
        import_at: '',
        EXP: '',
        MFG: '',
        qty: 0,
        qtyimport: 0,
        qty_charge: 0,
        description: '',
        PID: '',
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
        qty_charge: [
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
            message: "Please select the date1",
            trigger: "change",
          },
        ],
        EXP: [
          {
            required: true,
            type: "date",
            message: "Please select the date2",
            trigger: "change",
          },
        ],
        import_at: [
          {
            required: true,
            type: "date",
            message: "Please select the date3",
            trigger: "change",
          },
        ],
        PID: [
          {
            required: true,
            message: "กรุณาเลือกด้วย !!",
            trigger: "change",
            type: "number",
          },
        ],
        storageID: [
          {
            required: true,
            message: "กรุณาเลือกด้วย !!",
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
    select(data) {
      get("/api-inv/import-p/" + data.value).then((res) => {
        this.formimportp.qtyimport = res.data.itemimport.qty;
      });
    },
    focusOut() {
      this.formimportp.qty_charge = parseFloat(`${this.formimportp.qty_charge.toFixed(2)}`);
      this.formimportp.qty = parseFloat(`${this.formimportp.qtyimport.toFixed(2)}`) + parseFloat(`${this.formimportp.qty_charge.toFixed(2)}`);
    },
    handleSubmit() {
      this.formimportp.UID = this.id
      this.$Loading.start();
      post("/api-inv/product/import", this.formimportp)
        .then((res) => {
          this.$Loading.finish();
          if (res.data.succeed) {
            this.$router.push("/product/recordlist");
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
  height: 350px;
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