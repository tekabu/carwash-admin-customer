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
  -H "Content-Type: application/json" \
  https://admin.example.com/api/customer/CUSTOMER_ID/top-ups \
  -d '{"amount":50.0,"notes":"App top-up"}'
```
Adds credit to a customer account.

## GET /api/customer/rfid/check/{rfid}
```bash
curl -H "Accept: application/json" \
  https://admin.example.com/api/customer/rfid/check/RFID_VALUE
```
Validates whether an RFID tag belongs to a registered customer.

## POST /api/customer/{customer}/balance/check
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  https://admin.example.com/api/customer/CUSTOMER_ID/balance/check
```
Returns the current balance for the customer.

## GET /api/customer/{customer}/points/redeem
```bash
curl -H "Accept: application/json" \
  https://admin.example.com/api/customer/CUSTOMER_ID/points/redeem?points=100
```
Redeem loyalty points for a customer; adjust `points` query to the desired amount.

## POST /api/customer/{customer}/checkout
```bash
curl -X POST \
  -H "Content-Type: application/json" \
  https://admin.example.com/api/customer/CUSTOMER_ID/checkout \
  -d '{"vehicle_type_id":1,"soap_type_id":2,"extras":[],"amount":25.5}'
```
Performs checkout for a customer with the requested services.
