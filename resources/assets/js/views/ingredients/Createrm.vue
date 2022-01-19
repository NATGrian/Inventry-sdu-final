<template>
  <div class="container-fluid" id="Createingredients-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/ingredients/list">วัตถุดิบ</BreadcrumbItem>
      <BreadcrumbItem>เพิ่มวัตถุดิบใหม่</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Form ref="formcreate" :model="formcreate" :rules="ruleCustom">
      <Row type="flex" justify="space-around" align="middle">
        <Col span="15">
        <div class="Createfrom1-rm">
          <Row>
            <Col span="24">
            <div class="title-from1">
              เพิ่มวัตถุดิบ เข้าระบบครังแรก
            </div>
            </Col>
            <Col span="24" class="sub-title1">
            ช่องที่มี <span style="color: rgb(255, 0, 0);">*</span> เป็นช่องที่จำเป็นต้องกรอก
            </Col>

          </Row>
          <br>
          <Row type="flex" justify="space-between">
            <Col span="10" class="left-Formitem">
            <FormItem prop="rc_no">
              <span slot="label" style="width: 10%;">RC / NO:</span>
              <Input type="text" element-id="formcreate-rc_no" v-model="formcreate.rc_no" placeholder="" style="width: 65%;" size="small" />

            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="itemname">
              <span slot="label" style="width: 10%;">รายการ:</span>
              <Input type="text" element-id="formcreate-itemname" v-model="formcreate.itemname" placeholder="" style="width: 65%;" size="small" />

            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="10" class="left-Formitem">
            <FormItem prop="invoice_no">
              <span slot="label" style="width: 10%;">เลขที่ใบส่งของ:</span>
              <Input type="text" element-id="formcreate-invoice_no" v-model="formcreate.invoice_no" placeholder="" style="width: 50%;" size="small" />

            </FormItem>
            </Col>
            <Col span="10" class="right-Formitem">
            <FormItem prop="qty">
              <span slot="label" style="width: 10%;">จำนวน:</span>
              <InputNumber size="small" element-id="formcreate-qty" v-model="formcreate.qty" @on-blur="focusOut" controls-outside />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="space-between">
            <Col span="9" class="left-Formitem">
            <FormItem prop="LOT_no">
              <span slot="label" style="width: 10%;">Lot No:</span>
              <Input type="text" element-id="formcreate-LOT_no" v-model="formcreate.LOT_no" placeholder="" style="width: 55%;" size="small" />

            </FormItem>
            </Col>
            <Col span="13" class="right-Formitem">
            <FormItem prop="PID">
              <span slot="label" style="width: 10%;">ผู้ผลิต/ผู้จัดจำหน่าย:</span>
              <Select element-id="formcreate-peoples" v-model="formcreate.PID" placeholder="ค้นหา ผู้ผลิต/ผู้จัดจำหน่าย" style="width: 45%;" size="small">
                <Option v-for="p in peoples" :value="p.id" :key="p.id">{{ p.firstname }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>

          <Row type="flex" justify="space-between">
            <Col span="7" class="left-Formitem">
            <FormItem prop="MFG">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป ที่ผลิต (MFG.):</span>
              <DatePicker element-id="formcreate-MFG" v-model="formcreate.MFG"  @on-change="(value) => this.formcreate.MFG=value.toString()"  size="small" type="date" format="yyyy-MM-dd" placeholder="Select date" style="width: 80%;" />

            </FormItem>
            </Col>
            <Col span="7">
            <FormItem prop="EXP">
              <span slot="label" style="width: 10px;word-wrap: break-word;">ว-ด-ป หมดอายุ (EXP.):</span>
              <DatePicker element-id="formcreate-EXP" v-model="formcreate.EXP"  @on-change="(value) => this.formcreate.EXP=value.toString()"  size="small" type="date" format="yyyy-MM-dd"  placeholder="Select date" style="width: 80%;" />
            </FormItem>
            </Col>
            <Col span="7" class="right-Formitem">
            <FormItem prop="import_at">
              <span slot="label" style="width: 10%;word-wrap: break-word;">ว-ด-ป นำเข้า:</span>
              <DatePicker element-id="formcreate-import_at" v-model="formcreate.import_at" @on-change="(value) => this.formcreate.import_at=value.toString()" size="small" type="date" format="yyyy-MM-dd"  placeholder="Select date" style="width: 80%;" />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center">
            <Col span="11">
            <FormItem prop="storageID">
              <span slot="label" style="width: 10%;">สถานที่จัดเก็บ</span>
              <Select element-id="formcreate-storage" v-model="formcreate.storageID" placeholder="ค้นหา ที่เก็บ" style="width: 50%;" size="small">
                <Option v-for="s in storage" :value="s.id" :key="s.id">{{ s.name }}</Option>
              </Select>

            </FormItem>
            </Col>
            <Col span="11">
            <FormItem prop="CID">
              <span slot="label" style="width: 10%;">ประเภทของสิ่งของ</span>
              <Select element-id="formcreate-categorys" v-model="formcreate.CID" placeholder="ค้นหา ประเภท" style="width: 50%;" size="small">
                <Option v-for="c in categorys" :value="c.id" :key="c.id">{{ c.name }}</Option>
              </Select>

            </FormItem>
            </Col>
          </Row>
        </div>
        </Col>

        <Col span="7">
        
        <div class="Createfrom2-rm">
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">รายละเอียดย่อย</span>
              <Input element-id="formcreate-name" v-model="formcreate.description" :autosize="{minRows: 2,maxRows: 5}" type="textarea" size="small" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <div class="input-role">
              <span style="display: inline-block;">ผู้ตรวจรับ</span>
              <Input  readonly type="text" size="small" v-model="formcreate.UID" style="width: auto; display: inline-block;" />
            </div>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center">
            <Col span="24">
            <FormItem>
              <Row type="flex" justify="center">
                <Button type="primary" @click="handleSubmit" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มรายการ</Button>
                <Button @click="handleReset('formcreate')" style="margin-left: 8px">Reset</Button>
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
      this.formcreate.UID = res.data.user.firstname;
      this.id = res.data.user.id;
    });
    get("/api-inv/peoples").then((res) => {
      this.peoples = res.data.peoples;
    });
    get("/api-inv/storages").then((res) => {
      this.storage = res.data.storages;
    });
    get("/api-inv/category").then((res) => {
      this.categorys = res.data.category;
    });
  },
  data() {
    return {
      id: '',
      users: [],
      peoples: [],
      storage: [],
      categorys: [],
      formcreate: {
        rc_no: '',
        UID: '',
        itemname: '',
        import_at: '',
        EXP: '',
        MFG: '',
        qty: 1,
        invoice_no: '',
        description: '...',
        LOT_no: '',
        PID: '',
        storageID: '',
        CID:'',
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
            message: "กรุณากรอกด้วย !!",
            trigger: "change",
          },
        ],
        EXP: [
          {
            required: true,
            type: "date",
            message: "กรุณากรอกด้วย !!",
            trigger: "change",
          },
        ],
        import_at: [
          {
            required: true,
            type: "date",
            message: "กรุณากรอกด้วย !!",
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
        CID: [
          {
            required: true,
            message: "กรุณาเลือกด้วย !!",
            trigger: "change",
            type: "number",
          },
        ],
        desc: [
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
        this.formcreate.qty =  parseFloat(`${this.formcreate.qty.toFixed(2)}`);
    },
    handleSubmit() {
      this.formcreate.UID = this.id
      this.$Loading.start();
      post("/api-inv/ingredients", this.formcreate)
        .then((res) => {
          this.$Loading.finish();
          if (res.data.succeed) {
            this.$router.push("/ingredients/list");
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
.Createfrom1-rm {
  background-color: rgb(255, 255, 255);
  height: 420px;
}

.title-from1 {
  margin: 20px 0 0 40px;
  font-size: 15px;
  font-weight: bold;
  color: #000;
  text-shadow: 8px 4px 6px hsla(0, 0%, 58%, 0.659);
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
.Createfrom2-rm {
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