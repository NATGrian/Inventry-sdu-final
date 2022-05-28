<template>
  <div class="container-fluid" id="reportingredients-container">
    <Row type="flex" justify="space-between" align="middle">
      <Col>
      <Breadcrumb>
        <BreadcrumbItem to="/dashboard">Dashboard</BreadcrumbItem>
        <BreadcrumbItem to="/report">สต็อกการ์ด</BreadcrumbItem>
        <BreadcrumbItem>สต็อกการ์ดสำหรับ วัตถุดิบ</BreadcrumbItem>
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
          <div class="stockcard-labal">สร้างสต็อกการ์ดสำหรับ วัตถุดิบ</div>

          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="24">
          <Form ref="formstockcard" :model="formstockcard">
            <Row type="flex" justify="center" align="middle">

              <Col span="10">
              <FormItem :label-width="60">
                <span slot="label">รายการ:</span>
                <Select element-id="formstockcard-itemname" v-model="formstockcard.name_rm" filterable placeholder="ค้นหาวัตถุดิบ" style="width: 100%;">
                  <Option v-for="i in itemname" :value="i.itemname" :key="i.id">{{i.itemname}}</Option>
                </Select>
              </FormItem>
              </Col>
              <Col span="5">
              <FormItem :label-width="0">
                <span slot="label" style="color: rgba(0, 0, 0, 0);">.</span>
                <Button type="primary" size="small" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;" @click="Submit">ยืนยันรายการ</Button>
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
      <Table height="600" :columns="columns" :data="reportdata" size="small" ref="selection" :loading="loading">
        <template slot="footer">
          <Page :current="recordtotal.current_page" :total="recordtotal.total" size="small" simple @on-prev="onprev" @on-next="onnext" :page-size="recordtotal.per_page"/>
        </template>
      </Table>
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
              <div class="stockcard-labal">สต๊อกการ์ดสำหรับวัตถุดิบ</div>
              </Col>
            </Row>
            <br>
            <Row type="flex" justify="center" align="middle">
              <Col style="font-size: 20px;color: #000;">
              <div style="height: 45px;">ชื่อวัตถุดิบ </div>
              </Col>
              
              <Col span="11" offset="1" style="color: #000;font-size: 20px;">
              <div style="border-bottom: 1px dotted #000;height: 45px;"> : {{formstockcard.name_rm}}</div>
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
                <th colspan="1" rowspan="2" scope="colgroup">เลขที่ ใบส่งของ</th>
                <th colspan="1" rowspan="2" scope="colgroup">RC / no</th>
                <th colspan="3" rowspan="1" scope="colgroup">ปริมาณ (g)</th>
                <th colspan="1" rowspan="2" scope="colgroup">ใช้สำหรับผลิต(รหัสผลิตภัณฑ์)</th>
                <th colspan="1" rowspan="2" scope="colgroup">Lot No.</th>
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
                <td>{{ ri.invoice_no }}</td>
                <td>{{ ri.rc_no }}</td>
                <td>{{ ri.im_qty_charge }}</td>
                <td>{{ ri.ex_qty_charge }}</td>
                <td>{{ ri.qty_balance }}</td>
                <td>{{ ri.code_product }}</td>
                <td>{{ ri.LOT_no }}</td>
                <td>{{ ri.ufname }}</td>
                <td>{{ ri.pfname }}</td>
              </tr>
            </thead>
          </table>
          </Col>
        </Row>
        <Row type="flex" justify="end" class="code-row-bg">
          <Col>
          <Divider>
            <h6> รหัสเอกสาร: FM-WH-02 R00 </h6>
          </Divider>

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
      itemname: [],
      formstockcard: {
        name_rm: "",
      },
      columns: [
        {
          title: "ว / ด / ป",
          key: "imex_at",
          align: "center",
          width: 100,
        },
        {
          title: "เลขที่ ใบส่งของ",
          key: "invoice_no",
          align: "center",
          width: 120,
        },
        {
          title: "RC / no",
          key: "rc_no",
          align: "center",
          width: 100,
        },

        {
          title: "ปริมาณ (g)",
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
          title: "ใช้สำหรับผลิต(รหัสผลิตภัณฑ์)",
          align: "center",
          key: "code_product",
          width: 122,
        },
        {
          title: "Lot No.",
          key: "LOT_no",
          align: "center",
          width: 80,
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
      recordtotal: {},
      currentPage: 1,
      perPage: 2,
    };
  },
  methods: {
    onnext(page) {
      this.currentPage = page;
      this.getreports();
    },
    onprev(page) {
      this.currentPage = page;
      this.getreports();
    },
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
        "สต๊อคการ์ดสำหรับวัตถุดิบ" + date + " " + time;
      this.filename = timestamps;
    },
    Submit() {
      this.$Loading.start();

      post("/api-inv/reports/ingredients", this.formstockcard)
        .then((res) => {
          this.$Loading.finish();
          this.loading = true;
          if (res.data.succeed) {
            this.loading = false;
            this.reportdata = res.data.reportdata.data;
            this.recordtotal = res.data.reportdata;
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
    getreports() {
      let dataFetchUrl = `/api-inv/reports/getingredients?page=${this.currentPage}`;

      get(dataFetchUrl).then((res) => {
        if (res.data.succeed) {
          this.reportdata = res.data.reportdata.data;
          this.recordtotal = res.data.reportdata;

          this.loading = false;
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
    getingredients() {
      get("/api-inv/ingredients").then((res) => {
        this.itemname = res.data.list;
        this.loading = false;
      });
    },
  },
  created() {
    this.getingredients();
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
  min-height: 100px;
}
.stockcard-labal {
  display: inline-block;
  font-size: 25px;
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
  color: #212121;
}
</style>