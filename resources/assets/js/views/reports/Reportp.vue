<template>
  <div class="container-fluid">
    <Row type="flex" justify="space-between" align="middle">
      <Col>
      <Breadcrumb>
        <BreadcrumbItem to="/dashboard">Dashboard</BreadcrumbItem>
        <BreadcrumbItem to="/report">สต็อกการ์ด</BreadcrumbItem>
        <BreadcrumbItem>สต็อกการ์ดสำหรับ ผลิตภัณฑ์</BreadcrumbItem>
      </Breadcrumb>
      </Col>
      <!--  -->
      <Col>
      <Row>
        <Col>
        <Tooltip content="export to PDF" placement="top">
          <Button shape="circle" icon="md-archive" size="large" />
        </Tooltip>
        </Col>

        <Col>
        <Tooltip content="export to csv" placement="top">
          <Button shape="circle" icon="md-archive" size="large" />
        </Tooltip>
        </Col>

        <Col>
        <Tooltip content="สั่งปลิ้น" placement="top">
          <Button shape="circle" icon="md-print" size="large" />
        </Tooltip>
        </Col>

        <Col>
        <Tooltip content="ลบตาราง" placement="top">
          <Button shape="circle" icon="md-trash" size="large" />
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
              <FormItem :label-width="60">
                <span slot="label">รายการ:</span>
                <Select v-model="formstockcard.name_rm" :remote-method="remoteMethod1" :loading="loading1" filterable placeholder="ค้นหาผลิตภัณฑ์" style="width: 100%;">
                  <Option v-for="(item, index) in options1" :value="item.value" :key="index">{{item.label}}</Option>
                </Select>
              </FormItem>
              </Col>
              <Col span="6">
              <FormItem :label-width="100">
                <span slot="label" >ขนาดบรรจุ</span>
                <Input v-model="formstockcard.packing" placeholder="Enter something..." style="width: 100%" />
              </FormItem>
              </Col>
              <Col span="6">
              <FormItem :label-width="60">
                <span slot="label" >หน่วย</span>
                <Input v-model="formstockcard.unit" placeholder="Enter something..." style="width: 100%" />
              </FormItem>
              </Col>
              <Col span="5">
              <FormItem :label-width="0">
                <span slot="label" style="color: rgba(0, 0, 0, 0);">.</span>
                <Button type="primary" size="small" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">ยืนยันรายการ</Button>
              </FormItem>
              </Col>

            </Row>
            <Row type="flex" justify="center" align="middle">
              <Col span="12">
              <FormItem :label-width="120">
                <span slot="label">ตั้งค่าช่วงเวลา</span>
                <DatePicker confirm type="daterange" show-week-numbers placement="bottom-center" v-model="formstockcard.dates" placeholder="Select date" style="width: 75%;"></DatePicker>
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
      <Col span="23">
      <Table height="200" :columns="columns12" :data="data6"></Table>
      </Col>
    </Row>

  </div>
</template>

<script>
export default {
  data() {
    return {
      loading1: false,
      list: [],
      options1: [],
      formstockcard: {
        name_rm: "",
      },
      columns12: [
        {
          title: "ว / ด / ป",
          key: "name",
          align: "center",
          width: 90,
        },
        {
          title: "เลขที่ใบสั่งงาน",
          key: "age",
          align: "center",
          width: 119,
        },
        {
          title: "เลขที่ครังที่ผลิต",
          key: "address",
          align: "center",
          width: 100,
        },
        {
          title: "วันที่ผลิต",
          align: "center",
          key: "name",
          width: 100,
        },
        {
          title: "วันหมดอายุ",
          key: "age",
          align: "center",
          width: 100,
        },
        {
          title: "จำนวน (ชิ้น)",
          align: "center",
          children: [
            {
              title: "รับเข้า",
              key: "name",
              align: "center",
              width: 90,
            },
            {
              title: "จ่ายออก",
              key: "age",
              align: "center",
              width: 90,
            },
            {
              title: "คงเหลือ",
              key: "address",
              align: "center",
              width: 90,
            },
          ],
        },

        {
          title: "ผู้ปฎิบัติ",
          key: "address",
          align: "center",
          width: 120,
        },
        {
          title: "ผู้เบิก",
          align: "center",
          key: "address",
          width: 120,
        },
      ],
      data6: [],
    };
  },
  methods: {
    remoteMethod1(query) {
      if (query !== "") {
        this.loading1 = true;
        setTimeout(() => {
          this.loading1 = false;
          const list = this.list.map((item) => {
            return {
              value: item,
              label: item,
            };
          });
          this.options1 = list.filter(
            (item) => item.label.toLowerCase().indexOf(query.toLowerCase()) > -1
          );
        }, 200);
      } else {
        this.options1 = [];
      }
    },
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
</style>