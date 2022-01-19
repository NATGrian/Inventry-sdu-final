<template>
  <div class="container-fluid" id="reportproduct-container">
    <Row type="flex" justify="space-between" align="middle">
      <Col>
      <Breadcrumb>
        <BreadcrumbItem to="/dashboard">Dashboard</BreadcrumbItem>
        <BreadcrumbItem to="/report">สต็อกการ์ด</BreadcrumbItem>
        <BreadcrumbItem>สต็อกการ์ดสำหรับ ผลิตภัณฑ์</BreadcrumbItem>
      </Breadcrumb>
      </Col>
      <Col>
      <Row>
        <Col>
        <Tooltip content="export to PDF" placement="top">
          <Button id="btn-exportpdf" shape="circle" icon="md-archive" size="large" @click="exportpdf" />
        </Tooltip>
        </Col>

        <Col>
        <Tooltip content="export to csv" placement="top">
          <Button id="btn-exportcsv" shape="circle" icon="md-archive" size="large" @click="exportcsv" />
        </Tooltip>
        </Col>
      </Row>
      </Col>
    </Row>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col span="18">
      <div class="stockcardform">
        <br>
        <Row type="flex" justify="center" align="middle">

          <Col span="10">
          <div class="stockcard-labal">สร้างสต็อกการ์ดสำหรับ ผลิตภัณฑ์</div>

          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="24">
          <Form ref="formstockcard" :model="formstockcard">
            <Row type="flex" justify="center" align="middle">

              <Col span="6">
              <FormItem :label-width="65">
                <span slot="label">ผลิตภัณฑ์:</span>
                <Select element-id="formstockcard-itemname" v-model="formstockcard.itemname" filterable placeholder="ค้นหาผลิตภัณฑ์" style="width: 100%;">
                  <Option v-for="i in datalist" :value="i.itemname" :key="i.id">{{i.itemname}}</Option>
                </Select>
              </FormItem>
              </Col>
              <Col span="6">
              <FormItem :label-width="100">
                <span slot="label" >ขนาดบรรจุ</span>
                <Input element-id="formstockcard-packing" v-model="formstockcard.packing"  style="width: 100%" />
              </FormItem>
              </Col>
              <Col span="6">
              <FormItem :label-width="60">
                <span slot="label" >หน่วย</span>
                <Input element-id="formstockcard-unit" v-model="formstockcard.unit"  style="width: 100%" />
              </FormItem>
              </Col>
              <Col span="5">
              <FormItem :label-width="0">
                <span slot="label" style="color: rgba(0, 0, 0, 0);">.</span>
                <Button type="primary"  @click="Submit" size="small" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">ยืนยันรายการ</Button>
              </FormItem>
              </Col>

            </Row>
            <Row type="flex" justify="center" align="middle">
              <Col span="12">
              <FormItem :label-width="120">
                <span slot="label">ตั้งค่าช่วงเวลา</span>
                <DatePicker element-id="formstockcard-date" confirm type="daterange" format="yyyy-MM-dd" @on-change="daterange" show-week-numbers v-model="formstockcard.dates" placeholder="Select date" style="width: 75%;"></DatePicker>
              </FormItem>
              </Col>
            </Row>
          </Form>
          </Col>

        </Row>
        <Row>

        </Row>
      </div>
      </Col>
    </Row>
    <br>
    <Row type="flex" justify="center">
      <Col span="24">
      <Table height="600" :columns="columns" :data="reportdata" size="small" ref="selection" :loading="loading"></Table>
      </Col>
    </Row>
    <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true" :paginate-elements-by-height="1100" :filename="filename" :pdf-quality="2" :manual-pagination="false" pdf-format="letter" pdf-content-width="100%" pdf-orientation="landscape" @hasStartedGeneration="hasStartedGeneration()" @hasGenerated="hasGenerated($event)" ref="html2Pdf">
      <template slot="pdf-content">
        <Row type="flex" justify="center" align="middle">
          <Col span="18">
          <div class="stockcardform">
            <br>
            <Row type="flex" justify="center" align="middle">
              <Col span="12">
              <div class="stockcard-labal">สต็อกการ์ดผลิตภัณฑ์กึ่งสำเร็จรูปและสำเร็จรูป</div>
              </Col>
            </Row>
            <br>
            <Row type="flex" justify="center" align="middle">
              <Col>
              <span style="font-size: 20px;color: #000;">ชื่อวัตถุดิบ: {{formstockcard.itemname}} ขนาดบรรจุ: {{formstockcard.packing}} หน่วย: {{formstockcard.unit}} </span>
              </Col>
            </Row>
            <Row type="flex" justify="center" align="middle">
              <Col>
              <span>ช่วงเวลา: {{formstockcard.startdate}} ถึง {{formstockcard.enddate}}</span>
              </Col>
            </Row>
            <Row>
            </Row>
          </div>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center">
          <Col span="24">
          <table class="_table">
            <thead>
              <tr id="header__table">
                <th colspan="1" rowspan="2" scope="colgroup">ว / ด / ป</th>
                <th colspan="1" rowspan="2" scope="colgroup">เลขที่ใบสั่งงาน</th>
                <th colspan="1" rowspan="2" scope="colgroup">เลขที่ครังที่ผลิต</th>
                <th colspan="1" rowspan="2" scope="colgroup">วันที่ผลิต</th>
                <th colspan="1" rowspan="2" scope="colgroup">วันหมดอายุ</th>
                <th colspan="3" rowspan="1" scope="colgroup">จำนวน (ชิ้น)</th>
                <th colspan="1" rowspan="2" scope="colgroup">ผู้ปฎิบัติ</th>
                <th colspan="1" rowspan="2" scope="colgroup">ผู้เบิก</th>
              </tr>
              <tr style="background-color: transparent;">
                <th scope="col">รับเข้า</th>
                <th scope="col">จ่ายออก</th>
                <th scope="col">คงเหลือ</th>
              </tr>
              <tr v-for="ri in reportdata" :key="ri.id" id="content__table" >
                <td>{{ ri.imex_at }}</td>
                <td>{{ ri.order_no }}</td>
                <td>{{ ri.Batch_no }}</td>
                <td>{{ ri.MFG }}</td>
                <td>{{ ri.EXP }}</td>
                <td>{{ ri.im_qty_charge }}</td>
                <td>{{ ri.ex_qty_charge }}</td>
                <td>{{ ri.qty_balance }}</td>
                <td>{{ ri.ufname }}</td>
                <td>{{ ri.pfname }}</td>
              </tr>
            </thead>
          </table>
          </Col>
        </Row>
      </template>
    </vue-html2pdf>
  </div>
</template>

<script>
import { get, post } from "../../helpers/api";
import VueHtml2pdf from "vue-html2pdf";
export default {
  components: {
    VueHtml2pdf,
  },
  data() {
    return {
      loading: false,
      filename: "",
      datalist: [],
      formstockcard: {
        itemname: "",
        unit: "",
        packing: "",
        dates: "",
        startdate: "",
        enddate: "",
      },
      columns: [
        {
          title: "ว / ด / ป",
          key: "imex_at",
          align: "center",
          width: 100,
        },
        {
          title: "เลขที่ใบสั่งงาน",
          key: "order_no",
          align: "center",
          width: 120,
        },
        {
          title: "เลขที่ครังที่ผลิต",
          key: "Batch_no",
          align: "center",
          width: 100,
        },
        {
          title: "วันที่ผลิต",
          align: "center",
          key: "MFG",
          width: 100,
        },
        {
          title: "วันหมดอายุ",
          key: "EXP",
          align: "center",
          width: 100,
        },
        {
          title: "จำนวน (ชิ้น)",
          align: "center",
          children: [
            {
              title: "รับเข้า",
              key: "im_qty_charge",
              align: "center",
              width: 90,
            },
            {
              title: "จ่ายออก",
              key: "ex_qty_charge",
              align: "center",
              width: 90,
            },
            {
              title: "คงเหลือ",
              key: "qty_balance",
              align: "center",
              width: 90,
            },
          ],
        },

        {
          title: "ผู้ปฎิบัติ",
          key: "ufname",
          align: "center",
          width: 120,
        },
        {
          title: "ผู้เบิก",
          align: "center",
          key: "pfname",
          width: 120,
        },
      ],
      reportdata: [],
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
      const timestamps =
        "สต็อกการ์ดผลิตภัณฑ์กึ่งสำเร็จรูปและสำเร็จรูป" + date + " " + time;
      this.filename = timestamps;
    },
    Submit() {
      this.$Loading.start();

      post("/api-inv/reports/product", this.formstockcard)
        .then((res) => {
          this.$Loading.finish();
          this.loading = true;
          if (res.data.succeed) {
            this.loading = false;
            this.reportdata = res.data.reportdata;
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
    exportcsv() {
      this.$refs.selection.exportCsv({
        filename: this.filename,
      });
    },
    exportpdf() {
      this.$refs.html2Pdf.generatePdf();
    },
    daterange(date) {
      const startdate = date[0].toString();
      const enddate = date[1].toString();
      this.formstockcard.startdate = startdate;
      this.formstockcard.enddate = enddate;
    },
    getproducts() {
      get("/api-inv/products").then((res) => {
        this.datalist = res.data.list;
        this.loading = false;
      });
    },
  },
  created() {
    this.getproducts();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>


<style>
.ivu-form-item {
  margin-bottom: 0;
}
.stockcardform {
  background-color: rgb(255, 255, 255);
  min-height: 150px;
}
.stockcard-labal {
  display: inline-block;
  font-size: 20px;
  text-shadow: 2px 2px 0px #ffffff, 5px 4px 0px rgba(0, 0, 0, 0.15);
  color: #333333;
  margin-right: 5px;
}
th .ivu-table-cell {
  font-size: 12px;
}

#header__table th {
  font-size: 12px;
  background: #f5f7f9;
}
#content__table td {
  font-size: 10px;
}
</style>