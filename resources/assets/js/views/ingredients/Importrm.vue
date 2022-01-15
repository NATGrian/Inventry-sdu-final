<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/ingredients/list">วัตถุดิบ</BreadcrumbItem>
      <BreadcrumbItem>บันทึกการนำเข้าวัตถุดิบ</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Form ref="formimport" :model="formimport" :rules="ruleCustom">
      <Row type="flex" justify="space-around" align="middle">

        <Col span="15">

        <div class="Importfrom1-im">
          <Row>
            <Col span="24">
            <div class="title-from1-rm">
              บันทึกการนำเข้าวัตถุดิบ
            </div>
            </Col>
            <Col span="24" class="sub-title1-rm">
            ช่องที่มี <span style="color: rgb(255, 0, 0);">*</span> เป็นช่องที่จำเป็นต้องกรอก
            </Col>

          </Row>
          <br>
          <Row type="flex" justify="space-between">
            <Col span="10" class="left-Formitem">
            <FormItem prop="rc_no">
              <span slot="label" style="width: 10%;">RC / NO:</span>
              <Input type="text" v-model="formimport.rc_no" placeholder="" style="width: 65%;" size="small" />

            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="itemname">
              <span slot="label" style="width: 10%;">รายการ:</span>
              <Select v-model="formimport.itemname" @on-select="select" placeholder="ค้นหา วัตถุดิบ" style="width: 50%;" size="small" filterable>
                <Option v-for="i in itemrm" :value="i.id" :key="i.id">{{ i.itemname }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="10" class="left-Formitem">
            <FormItem prop="invoice_no">
              <span slot="label" style="width: 10%;">เลขที่ใบส่งของ:</span>
              <Input type="text" v-model="formimport.invoice_no" placeholder="" style="width: 50%;" size="small" />

            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="qty_charge">
              <span slot="label" style="width: 10%;">จำนวน:</span>
              <InputNumber size="small" v-model="formimport.qty_charge" @on-change="focusOut" controls-outside />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="9" class="left-Formitem">
            <FormItem prop="LOT_no">
              <span slot="label" style="width: 10%;">Lot No:</span>
              <Input type="text" v-model="formimport.LOT_no" placeholder="" style="width: 55%;" size="small" />

            </FormItem>
            </Col>
            <Col span="13" class="right-Formitem">
            <FormItem prop="PID">
              <span slot="label" style="width: 10%;">ผู้ผลิต/ผู้จัดจำหน่าย:</span>
              <Select v-model="formimport.PID" placeholder="ค้นหา ผู้ผลิต/ผู้จัดจำหน่าย" style="width: 45%;" size="small">
                <Option v-for="p in peoples" :value="p.id" :key="p.id">{{ p.firstname }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>

          <Row type="flex" justify="space-between">
            <Col span="7" class="left-Formitem">
            <FormItem prop="MFG">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป ที่ผลิต (MFG.):</span>
              <DatePicker v-model="formimport.MFG" @on-change="(value) => this.formimport.MFG=value.toString()" size="small" type="date" format="yyyy-MM-dd" placeholder="Select date" style="width: 80%;" />

            </FormItem>
            </Col>
            <Col span="7">
            <FormItem prop="EXP">
              <span slot="label" style="width: 10px;word-wrap: break-word;">ว-ด-ป หมดอายุ (EXP.):</span>
              <DatePicker v-model="formimport.EXP" @on-change="(value) => this.formimport.EXP=value.toString()" size="small" type="date" format="yyyy-MM-dd" placeholder="Select date" style="width: 80%;" />
            </FormItem>
            </Col>
            <Col span="7" class="right-Formitem">
            <FormItem prop="import_at">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป นำเข้า:</span>
              <DatePicker v-model="formimport.import_at" @on-change="(value) => this.formimport.import_at=value.toString()" size="small" type="date" :format="daterange" placeholder="Select date" style="width: 80%;" />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center">
            <Col span="12">
            <FormItem prop="storageID">
              <span slot="label" style="width: 10%;">สถานที่จัดเก็บ</span>
              <Select v-model="formimport.storageID" placeholder="ค้นหา ที่เก็บ" style="width: 50%;" size="small">
                <Option v-for="s in storage" :value="s.id" :key="s.id">{{ s.name }}</Option>
              </Select>

            </FormItem>
            </Col>
            
          </Row>
        </div>
        </Col>

        <Col span="7">
        <div class="Importfrom2-im">
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">รายละเอียดย่อย</span>
              <Input v-model="formimport.description" :autosize="{minRows: 2,maxRows: 5}" type="textarea" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">ผู้ตรวจรับ</span>
              <Input v-model="formimport.UID" readonly type="text" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <FormItem>
              <Row type="flex" justify="center">
                <Button type="primary" @click="handleSubmit" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มรายการ</Button>
                <Button @click="handleReset('formimport')" style="margin-left: 8px">Reset</Button>
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
      this.formimport.UID = res.data.user.firstname;
      this.id = res.data.user.id;
    });
    get("/api-inv/peoples").then((res) => {
      this.peoples = res.data.peoples;
    });
    get("/api-inv/storages").then((res) => {
      this.storage = res.data.storages;
    });
    get("/api-inv/ingredients").then((res) => {
      this.itemrm = res.data.list;
    });
  },
  data() {
    return {
      id: "",
      itemrm: [],
      users: [],
      peoples: [],
      storage: [],

      formimport: {
        rc_no: "",
        UID: "",
        itemname: "",
        import_at: "",
        EXP: "",
        MFG: "",
        qty: 0,
        qtyimport: 0,
        qty_charge: 0,
        invoice_no: "",
        description: "..",
        LOT_no: "",
        PID: "",
        storageID: "",
      },
      ruleCustom: {
        rc_no: [
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
        LOT_no: [
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
            message: "ตั้งค่าเวลา !!",
            trigger: "change",
          },
        ],
        EXP: [
          {
            required: true,
            type: "date",
            message: "ตั้งค่าเวลา !!",
            trigger: "change",
          },
        ],
        import_at: [
          {
            required: true,
            type: "date",
            message: "ตั้งค่าเวลา !!",
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
      console.log(data)
      get("/api/import/" + data.value).then((res) => {
        this.formimport.qtyimport = res.data.itemimport.qty;
        
      });
    },
    focusOut() {
      this.formimport.qty_charge = parseFloat(
        `${this.formimport.qty_charge.toFixed(2)}`
      );
      this.formimport.qty =
        parseFloat(`${this.formimport.qtyimport.toFixed(2)}`) +
        parseFloat(`${this.formimport.qty_charge.toFixed(2)}`);
    },
    handleSubmit() {
      this.formimport.UID = this.id
      this.$Loading.start();
      post("/api-inv/ingredients/import", this.formimport)
        .then((res) => {
          this.$Loading.finish();
          if (res.data.succeed) {
            this.$router.push("/ingredients/recordlist");
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
      this.formimport.rc_no = "";
      this.formimport.itemname = "";
      this.formimport.import_at = "";
      this.formimport.EXP = "";
      this.formimport.MFG = "";
      this.formimport.qty = 0;
      this.formimport.qtyimport = 0;
      this.formimport.qty_charge = 1;
      this.formimport.invoice_no = "";
      this.formimport.description = "";
      this.formimport.LOT_no = "";
      this.formimport.PID = "";
      this.formimport.storageID = "";
      this.formimport.CID = "";
    },
  },
};
</script>


<style>
.Importfrom1-im {
  background-color: rgb(255, 255, 255);
  height: 450px;
}

.title-from1-rm {
  margin: 20px 0 0 40px;
  font-size: 15px;
  font-weight: bold;
  color: #000;
  text-shadow: 8px 4px 6px #959595a8;
}
.sub-title1-rm {
  margin-left: 50px;
  font-size: 10px;
}
.left-Formitem {
  padding-left: 30px;
}
.right-Formitem {
  padding-right: 30px;
}
.Importfrom2-im {
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