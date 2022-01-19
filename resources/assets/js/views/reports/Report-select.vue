<template>
  <div class="container-fluid" id="reports-container">
    <Row type="flex" justify="space-between" align="middle">
      <Col>
      <Breadcrumb>
        <BreadcrumbItem to="/dashboard">Dashboard</BreadcrumbItem>
        <BreadcrumbItem>สต็อกการ์ด</BreadcrumbItem>
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
        <Tooltip content="print" placement="top">
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
          <div class="stockcard-labal">สร้างสต็อกการ์ดสำหรับ</div>
          <Dropdown trigger="click">
            <Button type="primary" size="small">
              เลือกประเภท
              <Icon type="ios-arrow-down"></Icon>
            </Button>
            <DropdownMenu slot="list">
              <DropdownItem><Button to="/report/ingredients" long size="small" type="text" ghost style="color: #000;">วัตถุดิบ</Button></DropdownItem>
              <DropdownItem><Button to="/report/products" long size="small" type="text" ghost style="color: #000;">ผลิตภัณฑ์</Button></DropdownItem>
            </DropdownMenu>
          </Dropdown>
          </Col>
        </Row>
        <br>
        <Row type="flex" justify="center" align="middle">
          <Col span="20">
          <Form ref="formstockcard" :model="formstockcard">
            <Row type="flex" justify="center" align="middle">
              <Col span="12">
              <FormItem :label-width="133">
                <span slot="label">รายการ:</span>
                <Select v-model="formstockcard.name_rm" disabled filterable placeholder="ค้นหา วัตถุดิบ" style="width: 80%;" size="small">
                  <Option v-for="item in list" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
              </FormItem>
              </Col>
              <Col span="8">
              <FormItem :label-width="0">
                <span slot="label" style="color: rgba(0, 0, 0, 0);">.</span>
                <Button type="primary" size="small" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">ยืนยันรายการ</Button>
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
      <Col span="20">
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
      formstockcard: {
        name_rm: "",
      },
      columns12: [],
      data6: [],
    };
  },
  methods: {},
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