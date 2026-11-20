<script setup>
import { ref } from 'vue'
import { API_BASE_URL } from '../config'

const emit = defineEmits(['added', 'cancel'])

const form = ref({
  emp_code: '',
  full_name: '',
  position: '',
  department: '',
  email: '',
  phone: '',
  salary: '',
})

const submitting = ref(false)
const successMsg = ref('')
const errorMsg = ref('')

const resetForm = () => {
  form.value = {
    emp_code: '',
    full_name: '',
    position: '',
    department: '',
    email: '',
    phone: '',
    salary: '',
  }
}

const handleSubmit = async () => {
  successMsg.value = ''
  errorMsg.value = ''
  submitting.value = true

  try {
    const res = await fetch(`${API_BASE_URL}/add_employee.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        ...form.value,
        salary: Number(form.value.salary || 0),
      }),
    })
    const result = await res.json()

    if (result.success) {
      successMsg.value = result.message || 'เพิ่มข้อมูลพนักงานเรียบร้อยแล้ว'
      resetForm()
      emit('added')
    } else {
      errorMsg.value = result.message || 'ไม่สามารถบันทึกข้อมูลได้'
    }
  } catch (err) {
    errorMsg.value = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ PHP API ได้'
  } finally {
    submitting.value = false
  }
}
</script>

<template>
  <div class="container mt-4 mb-5">
    <div class="card mx-auto" style="max-width: 680px">
      <div class="card-header bg-light">
        <h5 class="mb-0">เพิ่มข้อมูลพนักงาน</h5>
      </div>
      <div class="card-body">
        <div v-if="successMsg" class="alert alert-success py-2">{{ successMsg }}</div>
        <div v-if="errorMsg" class="alert alert-danger py-2">{{ errorMsg }}</div>

        <form @submit.prevent="handleSubmit">
          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">รหัสพนักงาน <span class="text-danger">*</span></label>
              <input
                v-model="form.emp_code"
                type="text"
                class="form-control"
                placeholder="เช่น EMP006"
                required
              />
            </div>
            <div class="col-md-8">
              <label class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
              <input
                v-model="form.full_name"
                type="text"
                class="form-control"
                placeholder="กรอกชื่อ-นามสกุล"
                required
              />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">ตำแหน่ง <span class="text-danger">*</span></label>
              <input
                v-model="form.position"
                type="text"
                class="form-control"
                placeholder="เช่น โปรแกรมเมอร์"
                required
              />
            </div>
            <div class="col-md-6">
              <label class="form-label">แผนก <span class="text-danger">*</span></label>
              <input
                v-model="form.department"
                type="text"
                class="form-control"
                placeholder="เช่น ไอที"
                required
              />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">อีเมล</label>
              <input
                v-model="form.email"
                type="email"
                class="form-control"
                placeholder="name@company.co.th"
              />
            </div>
            <div class="col-md-6">
              <label class="form-label">เบอร์โทรศัพท์</label>
              <input
                v-model="form.phone"
                type="text"
                class="form-control"
                placeholder="08x-xxx-xxxx"
              />
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label">เงินเดือน (บาท)</label>
            <input
              v-model="form.salary"
              type="number"
              min="0"
              step="100"
              class="form-control"
              placeholder="เช่น 32000"
            />
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary" @click="emit('cancel')">
              กลับไปหน้าแสดงข้อมูล
            </button>
            <button type="submit" class="btn btn-primary" :disabled="submitting">
              {{ submitting ? 'กำลังบันทึก...' : 'บันทึกข้อมูล' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
