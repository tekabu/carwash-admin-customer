# API curl examples (admin)

Base URL: `https://admin.example.com` (replace with your deployment).

## GET /api/vehicle-types
```bash
curl -H "Accept: application/json" \
  https://admin.example.com/api/vehicle-types
```
Retrieves vehicle types available in the system.

## GET /api/soap-types
```bash
curl -H "Accept: application/json" \
  https://admin.example.com/api/soap-types
```
List of soap/service types.

## POST /api/customer/{customer}/top-ups
```bash
curl -X POST \
  https://admin.example.com/api/customer/CUSTOMER_ID/top-ups \
  -F "proof_of_payment=@/path/to/receipt.jpg" \
  -F "top_up_amount=500.00" \
  -F "status=PENDING" \
  -F "remarks=Loaded via mobile app"
```
Uploads proof of payment and records a pending top-up for the selected customer (status defaults to `PENDING`).

## GET /api/customer/rfid/{rfid}/check
```bash
curl -H "Accept: application/json" \
  https://admin.example.com/api/customer/rfid/RFID_VALUE/check
```
Validates whether an RFID tag belongs to a registered customer.

## POST /api/customer/{customer}/balance/check
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  https://admin.example.com/api/customer/CUSTOMER_ID/balance/check \
  -d '{"cart_amount":150.75}'
```
Returns the current balance for the customer.

## GET /api/customer/{customer}/points/redeem
```bash
curl -H "Accept: application/json" \
  https://admin.example.com/api/customer/CUSTOMER_ID/points/redeem
```
Converts all redeemable points for the customer to balance using the server-defined ratio.

## POST /api/customer/checkout
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  https://admin.example.com/api/customer/checkout \
  -d '{
    "reference":"4b0ab96f-3f4e-4bb7-9f6a-1bd1c4bfb9d5",
    "vehicle_type_id":1,
    "soap_type_id":2,
    "total_amount":25.50,
    "payment_type":"BALANCE DEDUCTION"
  }'
```
Performs checkout for a customer with the requested services. Note: `customer_id` is optional.
