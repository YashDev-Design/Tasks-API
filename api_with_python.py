import requests
import json

# Base URL of your PHP Tasks API
BASE_URL = "http://localhost/tasks-api/public/index.php/tasks"

# 1️⃣ GET all tasks
def get_all_tasks():
    response = requests.get(BASE_URL)
    print("\n🟢 ALL TASKS:")
    print(json.dumps(response.json(), indent=4))

# 2️⃣ GET single task
def get_single_task(task_id):
    response = requests.get(f"{BASE_URL}/{task_id}")
    print(f"\n🟢 TASK {task_id}:")
    print(json.dumps(response.json(), indent=4))

# 3️⃣ POST (create new task)
def create_task():
    data = {
        "title": "Test Task from Python",
        "description": "This task was added using Python",
        "status": "pending",
        "priority": "medium",
        "due_date": "2025-10-20"
    }
    response = requests.post(BASE_URL, json=data)
    print("\n🟢 CREATED NEW TASK:")
    print(json.dumps(response.json(), indent=4))

# 4️⃣ PUT (update task)
def update_task(task_id):
    data = {
        "title": "Updated via Python Script",
        "description": "Modified from Python PUT request",
        "status": "in_progress",
        "priority": "high",
        "due_date": "2025-10-25"
    }
    response = requests.put(f"{BASE_URL}/{task_id}", json=data)
    print(f"\n🟡 UPDATED TASK {task_id}:")
    print(json.dumps(response.json(), indent=4))

# 5️⃣ DELETE a task
def delete_task(task_id):
    response = requests.delete(f"{BASE_URL}/{task_id}")
    print(f"\n🔴 DELETED TASK {task_id}:")
    print(json.dumps(response.json(), indent=4))

# 6️⃣ PATCH toggle status
def toggle_task(task_id):
    response = requests.patch(f"{BASE_URL}/{task_id}/toggle")
    print(f"\n🟢 TOGGLED TASK {task_id}:")
    print(json.dumps(response.json(), indent=4))


# ---------------------------------------------
# Run All Tests
# ---------------------------------------------
if __name__ == "__main__":
    # get_all_tasks()
    # create_task()
    # update_task(2)
    # toggle_task(4)
    # delete_task(7) 
    get_single_task(3)