<template>
  <div class="container-fluid">
    <Breadcrumb>
      <BreadcrumbItem to="/dashboard" replace>หน้าหลัก</BreadcrumbItem>
      <BreadcrumbItem to="/ingredients/list">วัตถุดิบ</BreadcrumbItem>
      <BreadcrumbItem>สร้างฉลากปิด</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col span="8">
      <Button @click="handleAdd" long type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">เพิ่มฉลาก</Button>
      </Col>
    </Row>
    <vue-html2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true" :paginate-elements-by-height="1100" :filename="filename" :pdf-quality="2" :manual-pagination="false" pdf-format="letter" pdf-content-width="100%" pdf-orientation="portrait" @hasStartedGeneration="hasStartedGeneration()" @hasGenerated="hasGenerated($event)" ref="html2Pdf">
      <template slot="pdf-content">
        <br>
        <br>
        <Form ref="formDynamic" :model="formDynamic" label-position="left">
          <Row type="flex" justify="space-around" align="middle">
            <Col span="11" v-for="(item, index) in formDynamic.items" style="border: #000 solid 1.5px;margin-bottom: 5px;" :key="index">
            <Row type="flex" justify="space-around" align="middle">
              <Col span="24" style="padding-left: 10px; margin: 5px; color: #000;">
              <h4 style="color: #000;">ฉลากปิดวัตถุดิบหลังชั่งน้ำหนัก</h4>
              </Col>
            </Row>
            <br>
            <Row type="flex" justify="space-around" align="middle">
              <Col span="9">
              <FormItem :prop="'items.' + index + '.RC_no'">
                <span slot="label" >RC / NO:</span>
                <div style="margin-left: 70px;border: #A4A4A4 solid 1px;padding-left: 10px;color: #000;">{{ item.RC_no1 }}</div>
              </FormItem>
              </Col>
              <Col span="7">
              <FormItem :prop="'items.' + index + '.value1'">
                <span slot="label" style="width: 30%;">จาก</span>
                <div style="margin-left: 35px;border: #A4A4A4 solid 1px;color: #000;padding: 0px 5px 0px 10px;"> {{ item.value1 }} / {{item.value2}}</div>
              </FormItem>
              </Col>

              <Col span="5">

              <FormItem :prop="'items.' + index + '.lot'">
                <span slot="label" style="width: 30%;">lot:</span>
                <div style="margin-left: 30px;border: #A4A4A4 solid 1px;padding-left: 10px;color: #000;">{{item.LOT_no}}</div>
                
              </FormItem>
              </Col>
            </Row>
            <Row type="flex" justify="space-around" align="middle">
              <Col span="11">
              <FormItem :prop="'items.' + index + '.products'">
                <span slot="label" >ผลิตภัณฑ์:</span>
                <div style="margin-left: 70px;border: #A4A4A4 solid 1px;padding-left: 10px;color: #000;">{{item.products}}</div>
              </FormItem>
              </Col>

              <Col span="11">
              <FormItem :prop="'items.' + index + '.rm'">
                <span slot="label" >วัตถุดิบ:</span>
                 <div style="margin-left: 70px;border: #A4A4A4 solid 1px;padding-left: 10px;color: #000;">{{item.itemname}}</div>
                
              </FormItem>
              </Col>
            </Row>
            <Row type="flex" justify="space-around" align="middle">
              <Col span="11">
              <FormItem :prop="'items.' + index + '.qty'">
                <span slot="label" style="width: 30%;">ปริมาณผลิต:</span>
                <Row>
                  <Col span="11" style="border-bottom: 1px dotted #000;">
                  {{item.qty}}
                  </Col>
                  <Col span="2" style="text-align: center; margin-left: 5px;"> กก.</Col>

                </Row>
              </FormItem>
              </Col>

              <Col span="11">

              <FormItem :prop="'items.' + index + '.qty2'">
                <span slot="label" style="width: 30%;">นน.สาร:</span>
                <Row>
                  <Col span="11" style="border-bottom: 1px dotted #000;">
                  {{item.qty2}}
                  </Col>
                  <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

                </Row>
              </FormItem>
              </Col>
            </Row>
            <Row type="flex" justify="space-around" align="middle">
              <Col span="11">
              <FormItem :prop="'items.' + index + '.qty1'">
                <span slot="label" style="width: 30%;">นน.ภาชนะเปล่า:</span>
                <Row>
                  <Col span="11" style="border-bottom: 1px dotted #000;">
                  {{item.qty1}}
                  </Col>
                  <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

                </Row>
              </FormItem>
              </Col>

              <Col span="11">
              <FormItem :prop="'items.' + index + '.qty3'">
                <span slot="label" style="width: 30%;">นน.รวม:</span>
                <Row>
                  <Col span="11" style="border-bottom: 1px dotted #000;">
                  {{item.qty3}}
                  </Col>
                  <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

                </Row>
              </FormItem>
              </Col>
            </Row>
            <Row type="flex" justify="space-around" align="middle">
              <Col span="11">
              <FormItem :prop="'items.' + index + '.member'">
                <span slot="label" style="width: 30%;">ผู้เตรียม</span>
                <Row>
                  <Col span="24" style="border-bottom: 1px dotted #000;">
                  :{{item.member}}
                  </Col>

                </Row>
                
                
                
              </FormItem>
              </Col>
            </Row>
            </Col>
          </Row>

        </Form>

      </template>
    </vue-html2pdf>
    <br>
    <Form ref="formDynamic" :model="formDynamic" label-position="left">
      <Row type="flex" justify="space-around" align="middle">
        <Col span="11" v-for="(item, index) in formDynamic.items" style="border: #000 solid 1.5px;" :key="index">
        <Row type="flex" justify="space-around" align="middle">
          <Col span="24" style="padding-left: 10px; margin: 5px; color: #000;">
          <h4>ฉลากปิดวัตถุดิบหลังชั่งน้ำหนัก</h4>
          </Col>
          <Col span="11">
          <FormItem :prop="'items.' + index + '.RC_no'">
            <span slot="label" style="width: 10%;">RC / NO:</span>
            <Select size="small" style="width: 65%;" @on-select="select" v-model="item.RC_no" placeholder="ค้นหาข้อมูลด้วย rc no" filterable :remote-method="remoteMethod" :loading="loading">
              <Option v-for="i in search" :value="i.id" :key="i.id" :label="i.rc_no" :tag="index">{{i.rc_no}}</Option>
            </Select>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.value1'">
            <span slot="label" style="width: 30%;">จาก</span>
            <Row>
              <Col span="11">
              <Input size="small" type="text" v-model="item.value1" placeholder="" />
              </Col>
              <Col span="2" style="text-align: center">/</Col>
              <Col span="11">
              <Input size="small" type="text" v-model="item.value2" placeholder="" />
              </Col>
            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.rm'">
            <span slot="label" style="width: 10%;">วัตถุดิบ:</span>
            <Input size="small" type="text" v-model="item.itemname" style="width: 65%;" />
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.products'">
            <span slot="label" style="width: 30%;">ผลิตภัณฑ:์</span>
            <Select v-model="item.products" filterable style="width: 60%;">
              <Option v-for="p in products" :value="p.itemname" :key="p.id">{{ p.itemname }}</Option>
            </Select>

          </FormItem>
          </Col>

          <Col span="8">
          <FormItem :prop="'items.' + index + '.lot'">
            <span slot="label" style="width: 30%;">lot:</span>
            <Input size="small" type="text" v-model="item.LOT_no" style="width: 55%;" />
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.qty'">
            <span slot="label" style="width: 30%;">ปริมาณผลิต:</span>
            <Row>
              <Col span="11">
              <InputNumber size="small" v-model="item.qty" placeholder="" style="width: 100%;" />
              </Col>
              <Col span="2" style="text-align: center; margin-left: 5px;"> กก.</Col>

            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.qty1'">
            <span slot="label" style="width: 30%;">นน.ภาชนะเปล่า:</span>
            <Row>
              <Col span="11">
              <InputNumber size="small" v-model="item.qty1" placeholder="" @on-change="focusOut(index)" style="width: 100%;" />
              </Col>
              <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.qty2'">
            <span slot="label" style="width: 30%;">นน.สาร:</span>
            <Row>
              <Col span="11">
              <InputNumber size="small" v-model="item.qty2" placeholder="" style="width: 100%;" />
              </Col>
              <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.qty3'">
            <span slot="label" style="width: 30%;">นน.รวม:</span>
            <Row>
              <Col span="11">
              <Input size="small" type="text" v-model="item.qty3" placeholder="" style="width: 100%;" />
              </Col>
              <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.member'">
            <span slot="label" style="width: 30%;">ผู้เตรียม:</span>
            <Input size="small" type="text" v-model="item.member" style="width: 55%;" />
          </FormItem>
          </Col>

        </Row>
        </Col>
      </Row>

    </Form>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col span="8">
      <Button long @click="exportpdf" type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">generate PDF</Button>
      </Col>
    </Row>
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
      search: [],
      filename: "",
      products: [],
      datarecord: [],
      loading: false,
      index: 1,
      itemname: [],
      formDynamic: {
        items: [
          {
            value1: "",
            value2: "",
            RC_no: "",
            RC_no1: "",
            member: "",
            qty3: 0,
            qty2: 0,
            qty1: 0,
            qty: 0,
            LOT_no: "",
            products: "",
            itemname: "",
            index: 1,
            status: 1,
          },
        ],
      },
    };
  },
  methods: {
    focusOut(index) {
      console.log(index);
      this.formDynamic.items[index].qty1 = parseFloat(
        `${this.formDynamic.items[index].qty1.toFixed(2)}`
      );
      this.formDynamic.items[index].qty3 =
        parseFloat(`${this.formDynamic.items[index].qty1.toFixed(2)}`) +
        parseFloat(`${this.formDynamic.items[index].qty2.toFixed(2)}`);
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
        "ภาพรวมการบันทึก นำเข้า - จ่ายออก (วัตถุดิบ)" + date + " " + time;
      this.filename = timestamps;
    },
    exportpdf() {
      this.$refs.html2Pdf.generatePdf();
    },
    getrecordingredients() {
      get("/api-inv/recordingredients").then((res) => {
        this.datarecord = res.data.record;
      });
    },
    getproducts() {
      get("/api-inv/products").then((res) => {
        this.products = res.data.list;
        this.loading = false;
      });
    },
    remoteMethod(query) {
      if (query !== "") {
        this.search = this.datarecord.filter(
          (i) => i.rc_no.indexOf(query) > -1
        );
      } else {
        this.search = [];
      }
    },
    handleReset(name) {
      this.$refs[name].resetFields();
    },
    handleAdd() {
      this.index++;
      this.formDynamic.items.push({
        value1: "",
        value2: "",
        RC_no: "",
        RC_no1: "",
        member: "",
        qty3: 0,
        qty2: 0,
        qty1: 0,
        qty: 0,
        LOT_no: "",
        products: "",
        itemname: "",
        index: this.index,
        status: 1,
      });
    },
    select(data) {
      console.log(data.label);
      get("/api-inv/Labelling/search/" + data.value).then((res) => {
        this.formDynamic.items[data.tag].itemname = res.data.labelling.itemname;
        this.formDynamic.items[data.tag].LOT_no = res.data.labelling.LOT_no;
        this.formDynamic.items[data.tag].qty2 = res.data.labelling.qty_charge;
        this.formDynamic.items[data.tag].RC_no1 = res.data.labelling.rc_no;
        this.$forceUpdate();
      });
    },
    handleRemove(index) {
      this.formDynamic.items[index].status = 0;
    },
  },
  created() {
    this.getrecordingredients();
    this.getproducts();
    setInterval(() => {
      this.timestamp();
    }, 1000);
  },
};
</script>

<style>
.Labelling-card {
  border: #000 solid 1.5px;
}

.ivu-form-item {
  margin-bottom: 0;
}
</style>