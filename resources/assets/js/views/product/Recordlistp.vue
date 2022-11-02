<template>
  <div class="container-fluid" id="recordlistproduct-container">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/product/list">ผลิตภัณฑ์</BreadcrumbItem>
      <BreadcrumbItem>ภาพรวมการบันทึก นำเข้า - จ่ายออก</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
      <Dropdown>
        <Button type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;"> บันทึก </Button>
        <DropdownMenu slot="list">
          <DropdownItem><Button to="/product/import" long size="small" type="text" icon="md-add" ghost style="color: #000;">บันทึก - นำเข้า</Button></DropdownItem>
          <DropdownItem><Button to="/product/export" long size="small" type="text" icon="md-add" ghost style="color: #000;">บันทึก - จ่ายออก</Button></DropdownItem>
        </DropdownMenu>
      </Dropdown>
      </Col>

      <Col>
      <Button type="primary" to="/report/products" icon="md-checkmark-circle-outline" style="background-color: rgb(0, 0, 0); border-color: white;">สต็อกการ์ด</Button>

      </Col>

      <Col span="9" offset="1">
      <Input search @on-search="tableItems" v-model="search" placeholder="ค้นหาตำแหน่งที่ต้องการ" style="width: 350px" />
      </Col>

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
    <br>
    <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true" :paginate-elements-by-height="1100" :filename="filename" :pdf-quality="2" :manual-pagination="false" pdf-format="letter" pdf-content-width="100%" pdf-orientation="landscape" @hasStartedGeneration="hasStartedGeneration()" @hasGenerated="hasGenerated($event)" ref="html2Pdf">
      <template slot="pdf-content">
        <Row type="flex" justify="center" align="middle">
          <Col>
          <h3 v-if="this.switch111">บันทึกการรับผลิตภัณฑ์กึ่งสำเร็จรูปและสำเร็จรูปเข้าคลังสินค้า</h3>
          <h3 v-else>บันทึกการจ่ายออกผลิตภัณฑ์กึ่งสำเร็จรูปและสำเร็จรูป</h3>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle" v-if="this.switch111">
          <Col span="24">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">วันที่รับ</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">รายการ</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">เลขที่ครั้งที่ผลิต</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">วันที่ผลิต</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">วันหมดอายุ</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">จำนวน</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">ผู้ส่ง</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">ผู้ตรวจรับ</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">สถานที่จัดเก็บ</th>
                <th style="font-size: 10px;padding: 8px 1px;min-width: 80px;">หมายเหตุ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="im in datarecord" :key="im.id">
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.import_at}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.itemname}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.Batch_no}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.MFG}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.EXP}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.qty_charge}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.pfname}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.ufname}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.name}}</td>
                <td style="font-size: 10px;padding: 8px 1px;min-width: 80px;width: 80px;">{{im.description}}</td>
              </tr>
            </tbody>
          </table>
          </Col>
        </Row>
        <Row type="flex" justify="center" align="middle" v-else>
          <Col span="20">
          <table class="_table" ref="selection">
            <thead>
              <tr id="_header-table">
                <th style="font-size: 10px;">ว-ด-ป นำออก</th>
                <th style="font-size: 10px;min-width: 80px;width: 80px;">รายการ</th>
                <th style="font-size: 10px;">เลขที่ใบสั่งงาน</th>
                <th style="font-size: 10px;">จำนวนที่จ่ายออก</th>
                <th style="font-size: 10px;">ผู้เบิก</th>
                <th style="font-size: 10px;">ผู้ปฏิบัติ</th>
                <th style="font-size: 10px;">หมายเหตุ</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="ie in datarecord1" :key="ie.id">
                <td style="font-size: 10px;">{{ie.export_at}}</td>
                <td style="font-size: 10px;min-width: 80px;width: 80px;">{{ie.itemname}}</td>
                <td style="font-size: 10px;">{{ie.order_no}}</td>
                <td style="font-size: 10px;">{{ie.qty_charge}}</td>
                <td style="font-size: 10px;">{{ie.pfname}}</td>
                <td style="font-size: 10px;">{{ie.ufname}}</td>
                <td style="font-size: 10px;">{{ie.description}}</td>
              </tr>
            </tbody>
          </table>
          </Col>
        </Row>
        <Row type="flex" justify="end" class="code-row-bg">
          <Col>
          <Divider>
            <h6> รหัสเอกสาร: FM-WH-04 R00</h6>
          </Divider>

          </Col>
        </Row>

      </template>
    </vue-html2pdf>
    <Row type="flex" justify="center" align="middle">

      <Col span="4">
      <i-switch v-model="switch111" size="large" style="width: 80px;" true-color="#000" false-color="#000">
        <span slot="open" style="font-size: 13px;">การนำเข้า</span>
        <span slot="close" style="font-size: 13px;">การจ่ายออก</span>
      </i-switch>

      </Col>

    </Row>
    <br>
    <Row type="flex" justify="center">
      <Table height="500" border ref="selection" :columns="columns" :data="datarecord" size="small" :loading="loading" v-if="this.switch111">

        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show(index)">View</Button>
          <Button type="error" size="small" @click="remove(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :current="recordtotal.current_page" :total="recordtotal.total" size="small" simple @on-prev="onprev" @on-next="onnext" :page-size="recordtotal.per_page"/>
        </template>
      </Table>
      <Table height="500" border ref="selection" :columns="columns1" :data="datarecord1" size="small" :loading="loading" v-else>

        <template slot-scope="{ index }" slot="action">
          <Button type="primary" size="small" style="margin-right: 3px" @click="show1(index)">View</Button>
          <Button type="error" size="small" @click="remove1(index)">Delete</Button>
        </template>
        <template slot="footer">
          <Page :current="recordtotal1.current_page" :total="recordtotal1.total" size="small" simple @on-prev="onprev" @on-next="onnext" :page-size="recordtotal1.per_page"/>
        </template>
      </Table>
    </Row>
    <Modal v-model="modalshowecord" title="ข้อมูล นำเข้า" footer-hide width="700" draggable>
      <p slot="header" style="color:#0423A9;text-align:center">
        <Icon type="ios-information-circle"></Icon>
        <span>ข้อมูล นำเข้าของ: {{ showdataim.itemname }}</span>
      </p>
      <Row type="flex" justify="center" align="middle" :gutter="16">

        <Col>
        <span> <b style="color: #000;">เลขที่ครั้งที่ผลิต :</b> {{ showdataim.Batch_no }} </span>
        </Col>

      </Row>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="12">
        <Divider>ว / ด / ป</Divider>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">วันที่รับ :</b> {{ showdataim.import_at }} </span>
          </Col>
        </Row>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">วันที่ผลิต :</b> {{ showdataim.MFG }} </span>
          </Col>
        </Row>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">วันหมดอายุ :</b> {{ showdataim.EXP }} </span>
          </Col>
        </Row>
        </Col>
        <Col span="12">
        <Divider>จำนวน</Divider>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">จำนวนที่รับ :</b> {{ showdataim.qty_charge }} </span>
          </Col>
        </Row>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">จำนวนคงเหลือ :</b> {{ showdataim.qty_balance }} </span>
          </Col>
        </Row>
        </Col>
        <Divider />
        <Row type="flex" justify="center" align="middle" :gutter="16">
          <Col>
          <span> <b style="color: #000;">ผู้ผลิต/ผู้จัดจำหน่าย :</b> {{ showdataim.pfname }} </span>
          </Col>
          <Col>
          <span> <b style="color: #000;">ชื่อผู้ตรวจรับ :</b> {{ showdataim.ufname }} </span>
          </Col>
          <Col>
          <span> <b style="color: #000;">สถานที่จัดเก็บ :</b> {{ showdataim.name }} </span>
          </Col>
        </Row>
      </Row>

    </Modal>
    <Modal v-model="modalshowecord1" title="ข้อมูล จ่ายออก" footer-hide width="700" draggable>
      <p slot="header" style="color:#0423A9;text-align:center">
        <Icon type="ios-information-circle"></Icon>
        <span>ข้อมูล จ่ายออกของ: {{ showdataex.itemname }}</span>
      </p>
      <Row type="flex" justify="center" align="middle" :gutter="16">
        <Col>
        <span> <b style="color: #000;">เลขที่ใบสั่งงาน :</b> {{ showdataex.order_no }} </span>
        </Col>
        <Col>
        <span> <b style="color: #000;">วันที่จ่ายออก :</b> {{ showdataex.export_at }} </span>
        </Col>
      </Row>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="12">
        <Divider>เจ้าหน้าที่</Divider>
        <Row type="flex" justify="center" align="middle" :gutter="16">
          <Col>
          <span> <b style="color: #000;">ผู้ผลิต/ผู้จัดจำหน่าย :</b> {{ showdataex.pfname }} </span>
          </Col>
          <Col>
          <span> <b style="color: #000;">ชื่อผู้ตรวจรับ :</b> {{ showdataex.ufname }} </span>
          </Col>
        </Row>
        </Col>
        <Col span="12">
        <Divider>จำนวน</Divider>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">จำนวนที่จ่ายออก :</b> {{ showdataex.qty_charge }} </span>
          </Col>
        </Row>
        <Row type="flex" justify="center" align="middle">
          <Col>
          <span> <b style="color: #000;">จำนวนคงเหลือ :</b> {{ showdataex.qty_balance }} </span>
          </Col>
        </Row>
        </Col>

      </Row>
    </Modal>
    <Modal v-model="modalConfirm" width="500" draggable @on-ok="confirm" @on-cancel="cancelcf">
      <p slot="header" style="color:#2E9AFE;text-align:center">
        <Icon type="md-help-circle" />
        <span style="color:#FF0000;">แน่ใจว่า ต้องการลบ</span>
      </p>
      <Row type="flex" justify="space-around" align="middle">
        <Col span="10">
        <Icon type="ios-trash" size="35" color="#FF0040" /> <span style="color:#482728; font-size: 20px; text-align: center;">ยืนยัน กดตกลง</span>
        </Col>

      </Row>

    </Modal>
  </div>
</template>


<script>
import VueHtml2pdf from "vue-html2pdf";
import { get, del } from "../../helpers/api";
export default {
  components: {
    VueHtml2pdf,
  },
  data() {
    return {
      loading: true,
      modalshowecord: false,
      modalshowecord1: false,
      modalConfirm: false,
      filename: "",
      search: "",
      deletingIndex: "",
      switch111: true,
      deletingform: {
        deletingID: "",
        checkstatus: "",
        idproduct: 1,
        deqty_charge: 0,
      },
      showdataex: {

      },
      showdataim: {

      },
      columns: [
        {
          title: "ว / ด / ป",
          key: "import_at",
          width: 100,
          align: "center",
        },
        {
          title: "รายการ",
          key: "itemname",
          width: 200,
          align: "center",
        },
        {
          title: "เลขที่การผลิต",
          key: "Batch_no",
          width: 100,
          align: "center",
        },

        {
          title: "จำนวน",
          key: "qty_charge",
          width: 90,
          align: "center",
        },
        {
          title: "จำนวนคงเหลือ",
          key: "qty_balance",
          width: 100,
          align: "center",
        },
        {
          title: "สถานะ",
          key: "status",
          width: 100,
          align: "center",
        },
        {
          title: "ผู้ปฎิบัติ",
          key: "ufname",
          width: 170,
          align: "center",
        },
        {
          title: "ตัวเลือก",
          key: "action",
          width: 150,
          align: "center",
          slot: "action",
        },
      ],
      columns1: [
        {
          title: "ว / ด / ป",
          key: "export_at",
          width: 100,
          align: "center",
        },

        {
          title: "เลขที่ใบสั่งงาน",
          key: "order_no",
          width: 150,
          align: "center",
        },
        {
          title: "รายการ",
          key: "itemname",
          width: 150,
          align: "center",
        },
        {
          title: "จำนวน",
          key: "qty_charge",
          width: 90,
          align: "center",
        },
        {
          title: "จำนวนคงเหลือ",
          key: "qty_balance",
          width: 90,
          align: "center",
        },
        {
          title: "สถานะ",
          key: "status",
          width: 100,
          align: "center",
        },
        {
          title: "ผู้ปฎิบัติ",
          key: "ufname",
          width: 150,
          align: "center",
        },
        {
          title: "ตัวเลือก",
          key: "action",
          width: 150,
          align: "center",
          slot: "action",
        },
      ],
      datarecord: [],
      datarecord1: [],
      recordtotal: {},
      recordtotal1: {},
      currentPage: 1,
      perPage: 10,
    };
  },
  methods: {
    onnext(page) {
      this.currentPage = page;
      this.getrecordpackagings();
    },
    onprev(page) {
      this.currentPage = page;
      this.getrecordpackagings();
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
        "ภาพรวมการบันทึก นำเข้า - จ่ายออก (ผลิตภัณฑ์) " + date + " " + time;
      this.filename = timestamps;
    },
    tableItems(value) {
      const data = this.datarecord;
      const data1 = this.datarecord1;
      if (value.length > 0) {
        if (
          data.filter((list) => list.itemname === this.search) ||
          data1.filter((list1) => list1.itemname === this.search)
        ) {
          this.datarecord = data.filter(
            (list) =>
              list.itemname.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
          this.datarecord1 = data1.filter(
            (list1) =>
              list1.itemname.toLowerCase().indexOf(value.toLowerCase()) > -1
          );
        } else {
          this.getrecordproduct();
        }
      } else {
        this.getrecordproduct();
      }
    },
    exportcsv() {
      this.$refs.selection.exportCsv({
        filename: this.filename,
      });
    },
    exportpdf() {
      this.$refs.html2Pdf.generatePdf();
    },
    show(index) {
      this.modalshowecord = true;
      this.showdataim.EXP = this.datarecord[index].EXP;
      this.showdataim.MFG = this.datarecord[index].MFG;
      this.showdataim.created_at = this.datarecord[index].created_at;
      this.showdataim.description = this.datarecord[index].description;
      this.showdataim.import_at = this.datarecord[index].import_at;
      this.showdataim.Batch_no = this.datarecord[index].Batch_no;
      this.showdataim.itemname = this.datarecord[index].itemname;
      this.showdataim.name = this.datarecord[index].name;
      this.showdataim.pfname = this.datarecord[index].pfname;
      this.showdataim.qty_balance = this.datarecord[index].qty_balance;
      this.showdataim.qty_charge = this.datarecord[index].qty_charge;
      this.showdataim.status = this.datarecord[index].status;
      this.showdataim.ufname = this.datarecord[index].ufname;
    },
    show1(index) {
      this.modalshowecord1 = true;
      this.showdataex.created_at = this.datarecord1[index].created_at;
      this.showdataex.description = this.datarecord1[index].description;
      this.showdataex.export_at = this.datarecord1[index].export_at;
      this.showdataex.order_no = this.datarecord1[index].order_no;
      this.showdataex.itemname = this.datarecord1[index].itemname;
      this.showdataex.pfname = this.datarecord1[index].pfname;
      this.showdataex.qty_balance = this.datarecord1[index].qty_balance;
      this.showdataex.qty_charge = this.datarecord1[index].qty_charge;
      this.showdataex.status = this.datarecord1[index].status;
      this.showdataex.ufname = this.datarecord1[index].ufname;
    },
    confirm() {
      if (this.deletingform.checkstatus === "นำเข้า") {
        del("/api-inv/importdeleting-p", this.deletingform).then((res) => {
          this.$Loading.finish();
          this.datarecord.splice(this.deletingIndex, 1);
          if (res.data.DELETE) {
            this.modalConfirm = false;
          }
          this.$Message.info("สำเร็จ");
        });
      }
      if (this.deletingform.checkstatus === "นำออก") {
        del("/api-inv/exportdeleting-p", this.deletingform).then((res) => {
          this.$Loading.finish();
          this.datarecord1.splice(this.deletingIndex, 1);
          if (res.data.DELETE) {
            this.modalConfirm = false;
          }
          this.$Message.info("สำเร็จ");
        });
      }
    },
    cancelcf() {
      this.modalConfirm = false;
    },
    remove(index) {
      this.deletingIndex = index;
      this.deletingform.deletingID = this.datarecord[index].id;
      this.deletingform.deqty_charge = this.datarecord[index].qty_charge;
      this.deletingform.idproduct = this.datarecord[index].idproduct;
      this.deletingform.checkstatus = this.datarecord[index].status;
      this.modalConfirm = true;
    },
    remove1(index) {
      this.deletingIndex = index;
      this.deletingform.deletingID = this.datarecord1[index].id;
      this.deletingform.deqty_charge = this.datarecord1[index].qty_charge;
      this.deletingform.idproduct = this.datarecord1[index].idproduct;
      this.deletingform.checkstatus = this.datarecord1[index].status;
      this.modalConfirm = true;
    },
    getrecordproduct() {
      let dataFetchUrl = `/api-inv/recordproduct?page=${this.currentPage}`;
      get(dataFetchUrl).then((res) => {
        this.datarecord = res.data.recordproduct.data;
        this.datarecord1 = res.data.recordproduct1.data;
        this.recordtotal = res.data.recordproduct;
        this.recordtotal1 = res.data.recordproduct1;
        this.loading = false;
      });
    },
  },
  created() {
    this.getrecordproduct();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
.ivu-switch-large.ivu-switch-checked:after {
  left: 60px;
}
</style>

