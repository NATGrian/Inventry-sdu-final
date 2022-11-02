<template>
  <div class="container-fluid" id="exportproduct-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/product/list">ผลิตภัณฑ์</BreadcrumbItem>
      <BreadcrumbItem>บันทึก - จ่ายออก</BreadcrumbItem>
    </Breadcrumb>
    <br>

    <Row type="flex" justify="center" align="middle">
      <Col span="22" class="exportfrom-rm">
      <Row type="flex" justify="center">
        <Col span="22">
        <Row type="flex" align="middle">
          <Col span="24" class="title-fromEX">
          บันทึกการจ่ายออก ผลิตภัณฑ์
          </Col>
          <Col span="24" class="sub-titleEX">
          ช่องที่มี <span style="color: rgb(255, 0, 0);">*</span> เป็นช่องที่จำเป็นต้องกรอก
          </Col>
        </Row>
        <br>
        <Form id="formexport" ref="formexportp" :model="formexportp" :rules="ruleCustom">
          <Row type="flex" justify="center" align="middle">
            <Col span="10">
            <FormItem :label-width="133">
              <span slot="label">ผู้ปฏิบัติ:</span>
              <Input readonly v-model="formexportp.UID" type="text" size="small" placeholder="" style="width: 80%;" />

            </FormItem>
            </Col>
            <Col span="10" offset="1">
            <FormItem prop="PID">
              <span slot="label">ผู้เบิก</span>
              <Select element-id="formexport-peoples" v-model="formexportp.PID" placeholder="ค้นหา ผู้เบิก" style="width: 80%;" size="small">
                <Option v-for="p in peoples" :value="p.id" :key="p.id">{{ p.firstname }}</Option>
              </Select>
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="8">
            <FormItem prop="export_at">
              <span slot="label">ว-ด-ป นำออก:</span>
              <DatePicker element-id="formexport-export_at" v-model="formexportp.export_at" @on-change="(value) => this.formexportp.export_at=value.toString()" size="small" type="date" placeholder="Select date" style="width: 50%;" />

            </FormItem>
            </Col>
            <Col span="9">
            <FormItem prop="order_no" :label-width="133">
              <span slot="label" style="text-align: center;">เลขที่ใบสังงาน</span>
              <Input element-id="formexport-order_no" v-model="formexportp.order_no" type="text" placeholder="" style="width: 60%;" />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="20">
            <FormItem prop="invoice_no">
              <span slot="label" style="width: 10%;">ค้นหารายการ:</span>
              <Select element-id="formexport-search" v-model="formexportp.search"  @on-select="select" filterable prefix="md-barcode" style="width: 80%;">
                <Option v-for="g in getsearch" :value="g.id" :key="g.id">{{ g.itemname }} - {{ g.Batch_no }}</Option>
            </Select>

            </FormItem>
            </Col>

          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="12">
            <table class="EXtable">
              <tr>
                <th>รายการ</th>
                <th>จำนวน</th>
                <th>จำนวนคงเหลือ</th>
              </tr>
              <tr>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexportp.itemname" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>

                <td>
                  <FormItem prop="qty_charge" :label-width="0">
                    <InputNumber element-id="formexport-qty_charge" v-model="formexportp.qty_charge" size="small" @on-change="focusOut" controls-outside />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexportp.qty" type="text" size="small" placeholder="" />
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
              <Input element-id="formexport-description" v-model="formexportp.description" type="textarea" placeholder="" style="width: 80%;" />
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
      this.formexportp.UID = res.data.user.firstname;
      this.id = res.data.user.id;
    });
    get("/api-inv/peoples").then((res) => {
      this.peoples = res.data.peoples;
    });
    get("/api-inv/getexport-p").then((res) => {
      this.getsearch = res.data.recordproduct;
    });
  },
  data() {
    return {
      id: "",
      idproduct: "",
      getsearch: [],
      users: [],
      peoples: [],
      formexportp: {
        UID: '',
        PID: '',
        export_at: '',
        itemname: '',
        order_no: '',
        qty_ex: 0,
        qty_charge: 0,
        qty: 0,
        qty: '',
        search: '',
      },

      ruleCustom: {
        order_no: [
          {
            required: true,
            message: "กรุณากรอกด้วย !!",
            trigger: "blur",
          },
        ],
        PID: [
          {
            required: true,
            message: "กรุณาเลือก !!",
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
            message: "ตั้งค่าเวลา !!",
            trigger: "change",
          },
        ],
      },
    };
  },
  methods: {
    select(data) {
      // console.log(data)
      get("/api-inv/export-p/search/" + data.value).then((res) => {
        this.idproduct = res.data.itemexport.idproduct;
        this.formexportp.itemname = res.data.itemexport.itemname;
        this.formexportp.qty_ex = res.data.itemexport.qty ;
        this.formexportp.qty = res.data.itemexport.qty;
        this.$forceUpdate();
      });
    },
    focusOut() {
      this.formexportp.qty_charge = parseFloat(`${this.formexportp.qty_charge.toFixed(2)}`);
      this.formexportp.qty =
        parseFloat(`${this.formexportp.qty_ex.toFixed(2)}`) -
        parseFloat(`${this.formexportp.qty_charge.toFixed(2)}`);
    },
    handleSubmit() {
      this.formexportp.UID = this.id
      this.formexportp.itemname = this.idproduct
      this.$Loading.start();
      post("/api-inv/product/export", this.formexportp)
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