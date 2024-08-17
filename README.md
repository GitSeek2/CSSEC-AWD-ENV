# CSSEC-AWD-ENV

信安组（CSSEC）AWD 练习题目环境。需要配合可以动态注入 flag 的平台使用。

## 部署

```bash
git clone https://github.com/GitSeek2/CSSEC-AWD-ENV.git
cd CSSEC-AWD-ENV/web/CSSEC-AWD-1
docker build -t awd-challenge .
docker run -p 8080:80 -p 2222:22 -d awd-challenge
```
