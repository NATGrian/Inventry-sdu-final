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
            <Input size="small"  type="text" v-model="item.RC_no" placeholder="ค้นหาข้อมูลด้วย rc no" style="width: 65%;" />
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
              <Input size="small" type="text" v-model="item.value1" placeholder="" />
              </Col>
            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.rm'">
            <span slot="label" style="width: 10%;">วัตถุดิบ:</span>
            <Input size="small" type="text" v-model="item.rm" style="width: 65%;" />
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.products'">
            <span slot="label" style="width: 30%;">ผลิตภัณฑ:์</span>
            <Select v-model="item.products" filterable style="width: 60%;">
              <Option v-for="products in productList" :value="products.value" :key="products.value">{{ products.label }}</Option>
            </Select>

          </FormItem>
          </Col>

          <Col span="8">
          <FormItem :prop="'items.' + index + '.lot'">
            <span slot="label" style="width: 30%;">lot:</span>
            <Input size="small" type="text" v-model="item.lot"  style="width: 55%;" />
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.qty'">
            <span slot="label" style="width: 30%;">ปริมาณผลิต:</span>
            <Row>
              <Col span="11">
              <Input size="small" type="text" v-model="item.qty" placeholder="" />
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
              <Input size="small" type="text" v-model="item.qty1" placeholder="" />
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
              <Input size="small" type="text" v-model="item.qty2" placeholder="" />
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
              <Input size="small" type="text" v-model="item.qty3" placeholder="" />
              </Col>
              <Col span="2" style="text-align: center; margin-left: 5px;"> กรัม</Col>

            </Row>
          </FormItem>
          </Col>

          <Col span="11">
          <FormItem :prop="'items.' + index + '.member'">
            <span slot="label" style="width: 30%;">ผู้เตรียม:</span>
            <Input size="small" type="text" v-model="item.member"  style="width: 55%;" />
          </FormItem>
          </Col>

        </Row>
        </Col>
      </Row>

    </Form>
    <br>
    <Row type="flex" justify="center" align="middle">
      <Col span="8">
      <Button long type="primary" icon="md-add" style="background-color: rgb(0, 0, 0); border-color: white;">generate PDF</Button>
      </Col>
    </Row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      index: 1,
      formDynamic: {
        items: [
          {
            value1: "",
            RC_no: "",
            member: "",
            qty3: "",
            qty2: "",
            qty1: "",
            qty: "",
            lot: "",
            products: "",
            rm: "",
            index: 1,
            status: 1,
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
    handleAdd() {
      this.index++;
      this.formDynamic.items.push({
            value1: "",
            rcno: "",
            member: "",
            qty3: "",
            qty2: "",
            qty1: "",
            qty: "",
            lot: "",
            products: "",
            rm: "",
        index: this.index,
        status: 1,
      });
    },
    handleRemove(index) {
      this.formDynamic.items[index].status = 0;
    },
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