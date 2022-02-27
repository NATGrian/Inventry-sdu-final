<template>
  <div class="container-fluid" id="exportingredients-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/ingredients/list">วัตถุดิบ</BreadcrumbItem>
      <BreadcrumbItem>บันทึก - จ่ายออก</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Row type="flex" justify="center" align="middle">
      <Col span="22" class="exportfrom-rm">
      <Row type="flex" justify="center">
        <Col span="22">
        <Row type="flex" align="middle">
          <Col span="24" class="title-fromEX">
          บันทึกการจ่ายออก วัตถุดิบ
          </Col>
          <Col span="24" class="sub-titleEX">
          ช่องที่มี <span style="color: rgb(255, 0, 0);">*</span> เป็นช่องที่จำเป็นต้องกรอก
          </Col>
        </Row>
        <br>
        <Form id="formexport" ref="formexport" :model="formexport" :rules="ruleCustom">
          <Row type="flex" justify="center" align="middle">
            <Col span="10">
            <FormItem :label-width="133">
              <span slot="label">ผู้ปฏิบัติ:</span>
              <Input readonly v-model="formexport.UID" type="text" size="small" placeholder="" style="width: 80%;" />

            </FormItem>
            </Col>
            <Col span="10" offset="1">
            <FormItem prop="PID">
              <span slot="label">ผู้เบิก</span>
              <Select element-id="formexport-peoples" v-model="formexport.PID" placeholder="ค้นหา ผู้เบิก" style="width: 80%;" size="small">
                <Option v-for="p in peoples" :value="p.id" :key="p.id">{{ p.firstname }}</Option>
              </Select>
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="8">
            <FormItem prop="export_at">
              <span slot="label">ว-ด-ป นำออก:</span>
              <DatePicker element-id="formexport-export_at" v-model="formexport.export_at" @on-change="(value) => this.formexport.export_at=value.toString()" size="small" type="date" placeholder="Select date" style="width: 50%;" />

            </FormItem>
            </Col>
            <Col span="9">
            <FormItem prop="code_product" :label-width="133">
              <span slot="label" style="text-align: center;">ใช้สำหรับผลิต (รหัสผลิตภัณฑ์)</span>
              <Input element-id="formexport-code_product" v-model="formexport.code_product" type="text" placeholder="" style="width: 60%;" />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="20">
            <FormItem prop="search">
              <span slot="label" style="width: 10%;">ค้นหารายการ:</span>
              <Select element-id="formexport-search" v-model="formexport.search"  @on-select="select" filterable prefix="md-barcode" style="width: 80%;">
                <Option v-for="g in getsearch" :value="g.id" :key="g.id">{{ g.itemname }} - {{ g.rc_no }}</Option>
            </Select>
              

            </FormItem>
            </Col>

          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="22">
            <table class="EXtable">
              <tr>
                <th>รายการ</th>
                <th>RC / No</th>
                <th>เลขที่ใบส่งของ</th>
                <th>จำนวน</th>
                <th>จำนวนคงเหลือ</th>
                <th>Lot No.</th>
              </tr>
              <tr>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.itemname" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.rc_no" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.invoice_no" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem prop="qty_charge" :label-width="0">
                    <InputNumber element-id="formexport-qty_charge" v-model="formexport.qty_charge" @on-change="focusOut" size="small" controls-outside />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <InputNumber readonly v-model="formexport.qty"  type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.LOT_no" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
              </tr>

            </table>
            </Col>
          </Row>
          <br>
          <Row type="flex" justify="center" align="middle">
            <Col span="20">
            <FormItem prop="invoice_no">
              <span slot="label" style="width: 10%;">หมายเหตุ:</span>
              <Input element-id="formexport-description" v-model="formexport.description" type="textarea" placeholder="" style="width: 80%;" />
            </FormItem>
            </Col>

          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="4">
            <FormItem>
              <Button type="primary" @click="handleSubmit" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มรายการ</Button>
            </FormItem>
            </Col>

          </Row>
        </Form>
        </Col>
      </Row>
      </Col>
    </Row>
    <br>
  </div>
</template>

<script >
import { get, post, put } from "../../helpers/api";
export default {
  created() {
    get("/api-inv/users/" + localStorage.getItem("user_id")).then((res) => {
      this.users = res.data.user;
      this.formexport.UID = res.data.user.firstname;
      this.id = res.data.user.id;
    });
    get("/api-inv/peoples").then((res) => {
      this.peoples = res.data.peoples;
    });
    get("/api-inv/getexport").then((res) => {
      this.getsearch = res.data.record;
    });
  },
  data() {
    return {
      id: "",
      idrm: "",
      getsearch: [],
      users: [],
      peoples: [],
      formexport: {
        UID: '',
        PID: '',
        export_at: '',
        code_product: '',
        itemname: '',
        rc_no: '',
        invoice_no: '',
        qty_ex: 0,
        qty_charge: 0,
        qty: 0,
        LOT_no: '',
        description: '',
        search: '',
      },

      ruleCustom: {
        code_product: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        PID: [
          {
            required: true,
            message: "Please select the description",
            trigger: "change",
            type: "number",
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

        export_at: [
          {
            required: true,
            type: "date",
            message: "Please select the date3",
            trigger: "change",
          },
        ],
      },
    };
  },
  methods: {
    select(data) {
      // console.log(data)
      get("/api-inv/export/search/" + data.value).then((res) => {
        this.idrm = res.data.itemexport.idrm;
        this.formexport.itemname = res.data.itemexport.itemname;
        this.formexport.rc_no = res.data.itemexport.rc_no;
        this.formexport.invoice_no = res.data.itemexport.invoice_no;
        this.formexport.LOT_no = res.data.itemexport.LOT_no;
        this.formexport.qty_ex = res.data.itemexport.qty ;
        this.formexport.qty = res.data.itemexport.qty;
        this.$forceUpdate();
      });
    },
    focusOut() {
      this.formexport.qty_charge = parseFloat(`${this.formexport.qty_charge.toFixed(2)}`);
      this.formexport.qty =
        parseFloat(`${this.formexport.qty_ex.toFixed(2)}`) -
        parseFloat(`${this.formexport.qty_charge.toFixed(2)}`);
    },
    handleSubmit() {
      this.formexport.UID = this.id
      this.formexport.itemname = this.idrm
      this.$Loading.start();
      post("/api-inv/ingredients/export", this.formexport)
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
    },
  },
  mounted() {},
};
</script>


<style>
.exportfrom-rm {
  background-color: rgb(255, 255, 255);
  height: 550px;
}
.title-fromEX {
  margin: 20px 0 0 40px;
  font-size: 15px;
  font-weight: bold;
  color: #000;
  text-shadow: 8px 4px 6px #959595a8;
}
.sub-titleEX {
  margin-left: 50px;
  font-size: 10px;
}

.ivu-form-item-error-tip {
  font-size: 10px;
}
.ivu-form-item {
  margin-bottom: 10px;
}

.EXtable {
  border-collapse: collapse;
}

.EXtable td,
.EXtable th {
  border: 1px solid #000;
  text-align: center;
  padding: 8px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-right-color: transparent;
}
.EXtable th {
  font-weight: bold;
  font-size: 14px;
  color: #000;
}
.EXtable tr:nth-child(even) {
  background-color: #fff;
}
</style>