<template>
  <div class="container-fluid">
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
        <Form ref="formexport" :model="formexport" :rules="ruleCustom">
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
              <Select v-model="formexport.PID" placeholder="ค้นหา ผู้เบิก" style="width: 80%;" size="small">
                <Option v-for="item in formexport.PID" :value="item.value" :key="item.value">{{ item.label }}</Option>
              </Select>
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="8">
            <FormItem prop="export_at">
              <span slot="label">ว-ด-ป นำออก:</span>
              <DatePicker v-model="formexport.export_at" size="small" type="date" placeholder="Select date" style="width: 50%;" />

            </FormItem>
            </Col>
            <Col span="9">
            <FormItem prop="code_product" :label-width="133">
              <span slot="label" style="text-align: center;">ใช้สำหรับผลิต (รหัสผลิตภัณฑ์)</span>
              <Input v-model="formexport.code_product" type="text" placeholder="" style="width: 60%;" />
            </FormItem>
            </Col>
          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="20">
            <FormItem prop="invoice_no">
              <span slot="label" style="width: 10%;">ค้นหารายการ:</span>
              <Input v-model="formexport.storage_ID" prefix="md-barcode" type="text" placeholder="" style="width: 80%;" />

            </FormItem>
            </Col>

          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="20">
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
                    <Input readonly v-model="formexport.name_rm" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.RC_no" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.invoice_no" type="text" size="small" placeholder="" />
                  </FormItem>
                </td>
                <td>
                  <FormItem prop="qty_charge" :label-width="0">
                    <InputNumber v-model="formexport.qty_charge" size="small" :formatter="value => ` ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')" :parser="value => value.replace(/[^\d\.]/g, '') " controls-outside />
                  </FormItem>
                </td>
                <td>
                  <FormItem :label-width="0">
                    <Input readonly v-model="formexport.qty" type="text" size="small" placeholder="" />
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
              <Input v-model="formexport.storage_ID" type="textarea" placeholder="" style="width: 80%;" />
            </FormItem>
            </Col>

          </Row>
          <Row type="flex" justify="center" align="middle">
            <Col span="4">
            <FormItem>
              <Button type="primary" @click="handleSubmit('formexport')" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มรายการ</Button>
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
export default {
  data() {
    return {

      formexport: {
        UID: "",
        PID: [],
        export_at: "",
        code_product: "",
        storage_ID: "",
        name_rm: "",
        RC_no: "",
        invoice_no: "",
        qty_charge: "1",
        qty: "",
        LOT_no: "",
        storage_ID: "",
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
            message: "Please select the storage_ID",
            trigger: "change",
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

    handleSubmit(name) {
      this.$refs[name].validate((valid) => {
        if (valid) {
          this.$Message.success("Success!");
        } else {
          this.$Message.error("Fail!");
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