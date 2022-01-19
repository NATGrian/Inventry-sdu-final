<template>

  <div class="container-fluid" id="dashboard-container">
    <Breadcrumb>
        <BreadcrumbItem to="/dashboard">Dashboard</BreadcrumbItem>
        <BreadcrumbItem to="/dashboard">หน้าหลัก</BreadcrumbItem>
    </Breadcrumb>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col>
        <h1> ระบบคงคลังวัตถุดิบและผลิตภัณฑ์ สำหรับ คณะวิทยาศาสตร์เครื่องสําอาง</h1>
      </Col>
    </Row>
    <br>
    <Row type="flex" justify="space-around" align="middle">

      <Col :md="5" :xs="22">
        <Card :bordered="false" to="/ingredients/list">
          <div style="text-align:center">
            <Icon type="md-cube" size="40"/>

            <h5>วัตถุดิบคงเหลือ</h5>
          </div>
        </Card>
      </Col>

      <Col :md="5" :xs="22">
        <Card :bordered="false" to="/product/list">
          <div style="text-align:center">
            <Icon type="md-cube" size="40"/>

            <h5>ผลิตภัณฑ์คงเหลือ</h5>
          </div>
        </Card>
      </Col>

      <Col  :md="5" :xs="22">
        <Card :bordered="false" to="/member">
          <div style="text-align:center">
            <Icon type="md-contacts"  size="40"/>

            <h5>เจ้าหน้าที่ดูแลระบบ</h5>
          </div>
        </Card>
      </Col>

      <Col  :md="5" :xs="22">
        <Card :bordered="false" to="/report">
          <div style="text-align:center">
            <Icon type="ios-paper" size="40" />
            <h5>สต็อกการ์ด</h5>
          </div>
        </Card>
      </Col>
    </Row>
    <br>

    <!-- <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
      <p class="_title0">รายการที่ทำล่าสุด</p>

      <div class="_overflow _table_div">
        <Table height="200" :columns="columns1" :data="data"></Table>

      </div>
      <Page :total="40" size="small" show-elevator show-sizer />
    </div> -->

  </div>

</template>

<script>
export default {
  data() {
    return {
      columns1: [
        {
          title: "รายการ",
          key: "name-item",
        },
        {
          title: "ว / ด / ป",
          key: "date",
        },
        {
          title: "ประเภท",
          key: "type-item",
        },
        {
          title: "ผู้ปฎิบัติ",
          key: "name",
        },
        {
          title: "Action",
          key: "action",
          fixed: "right",
          width: 120,
          render: (h, params) => {
            return h("div", [
              h(
                "Button",
                {
                  props: {
                    type: "text",
                    size: "small",
                  },
                },
                "View"
              ),
              h(
                "Button",
                {
                  props: {
                    type: "text",
                    size: "small",
                  },
                },
                "Edit"
              ),
            ]);
          },
        },
      ],
      data: [
        {
          name: "",
          age: "",
          address: "",
          date: "",
        },
      ],
    };
  },
};
</script>
