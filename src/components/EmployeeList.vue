<script setup>
import { ref, computed, onMounted } from 'vue'
import { API_BASE_URL } from '../config'

const emit = defineEmits(['go-add'])

const employees = ref([])
const loading = ref(false)
const errorMsg = ref('')
const searchText = ref('')

const fetchEmployees = async () => {
  loading.value = true
  errorMsg.value = ''
  try {
    const res = await fetch(`${API_BASE_URL}/show_employees.php`)
    const result = await res.json()
    if (result.success) {
      employees.value = result.data
    } else {
      errorMsg.value = result.message || 'ไม่สามารถโหลดข้อมูลพนักงานได้'
    }
  } catch (err) {
    errorMsg.value = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ PHP API ได้'
  } finally {
    loading.value = false
  }
}

const filteredEmployees = computed(() => {
  const kw = searchText.value.trim().toLowerCase()
  if (!kw) return employees.value
  return employees.value.filter(
    (emp) =>
      emp.emp_code.toLowerCase().includes(kw) ||
      emp.full_name.toLowerCase().includes(kw) ||
      emp.position.toLowerCase().includes(kw) ||
      emp.department.toLowerCase().includes(kw)
  )
})

onMounted(fetchEmployees)
defineExpose({ fetchEmployees })
</script>

<template>
  <div class="container mt-4 mb-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
      <h4 class="mb-0">แสดงข้อมูลพนักงาน</h4>

      <div class="d-flex gap-2">
        <input
          v-model="searchText"
          type="text"
          class="form-control form-control-sm"
          placeholder="ค้นหารหัส ชื่อ หรือแผนก..."
          style="width: 220px"
        />
        <button class="btn btn-primary btn-sm" @click="emit('go-add')">
          + เพิ่มข้อมูลพนักงาน
        </button>
      </div>
    </div>

    <div v-if="errorMsg" class="alert alert-danger py-2">{{ errorMsg }}</div>

    <div v-if="loading" class="text-muted py-3">กำลังโหลดข้อมูล...</div>

    <div v-else class="table-responsive">
      <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th class="text-center" style="width: 55px">#</th>
            <th>รหัสพนักงาน</th>
            <th>ชื่อ-นามสกุล</th>
            <th>ตำแหน่ง</th>
            <th>แผนก</th>
            <th>อีเมล</th>
            <th>เบอร์โทรศัพท์</th>
            <th class="text-end">เงินเดือน (บาท)</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(emp, index) in filteredEmployees" :key="emp.id || emp.emp_code">
            <td class="text-center">{{ index + 1 }}</td>
            <td>{{ emp.emp_code }}</td>
            <td>{{ emp.full_name }}</td>
            <td>{{ emp.position }}</td>
            <td>{{ emp.department }}</td>
            <td>{{ emp.email }}</td>
            <td>{{ emp.phone }}</td>
            <td class="text-end">{{ Number(emp.salary).toLocaleString() }}</td>
          </tr>
          <tr v-if="filteredEmployees.length === 0">
            <td colspan="8" class="text-center text-muted py-3">ไม่พบข้อมูลพนักงาน</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p class="text-muted small mb-0">
      แสดงข้อมูลทั้งหมด {{ filteredEmployees.length }} รายการ
    </p>
  </div>
</template>
