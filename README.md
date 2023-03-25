# PHP Growatt Spreadsheet
[![NystronSolarBadge](https://img.shields.io/badge/%E2%9A%A1%20Powered%20By-Nystron%20Solar-yellow?style=for-the-badge)](https://github.com/NystronSolar)
[![semantic-release: angular](https://img.shields.io/badge/semantic--release-angular-e10079?logo=semantic-release&style=for-the-badge)](https://github.com/semantic-release/semantic-release)

**Read**, **Write** and **Manage Growatt Device Data Spreadsheets**

## The Package 🚀
The package provides several classes to extract Electric Bills. 
The project is separated in several classes. Each class extract an specific type of bill.
### Using the Package 🎮
Each extractor class have two main methods: `fromFile` and `fromContent`, and both returns an associative-array with all the bill data. 

## Example 🔧
Here, we will use the **Extractor RGE**, but it apply to any other extractor

```php
<?php

use NystronSolar\ElectricBillExtractor\BR\RS\ExtractorRGE;

$extractor = new ExtractorRGE(/* You can put an custom PDF Parser (from smalot/pdfparser Package) */);
$output = $extractor->fromFile('my_bill.pdf'); // You can also use the fromContent() method, that does the same, but accepting an PDF Content String.

echo json_encode($output);
```

This should return something like that:
```json
{
    "Client": {
        "Name": "Client Name",
        "Address": "Client Address",
        "District": "Client District",
        "City": "Client City",
        "Building": {
            "Classification": "Classification",
            "SupplyType": "Supply Type",
            "Voltage": {
                "Available": 220,
                "MinimumLimit": 202,
                "MaximumLimit": 231
            }
        }
    },
    "Batch": 1,
    "ReadingGuide": "Reading Guide",
    "PowerMeterId": 10000000,
    "Pages": {
        "Actual": 1,
        "Total": 1
    },
    "DeliveryDate": { /* PHP \DateTime Object */ },
    "NextReadingDate": { /* PHP \DateTime Object */ },
    "DueDate": { /* PHP \DateTime Object */ },
    "ActualReadingDate": { /* PHP \DateTime Object */ },
    "PreviousReadingDate": { /* PHP \DateTime Object */ },
    "TotalDays": 31,
    "InstallationCode": "Installation Code",
    "Date": { /* PHP \DateTime Object */ },
    "Cost": { /* Money from moneyphp/money Package */ },
    "Notices": {
        "Text": "Notices Text"
    },
    "SolarGeneration": {
        "ParticipationGeneration": 100,
        "Balance": 0,
        "NextMonthExpiringBalance": 0
    },
    "EnergyData": {
        "EnergyConsumed": {
            "Timetables": "Timetables",
            "PreviousReading": 1000,
            "ActualReading": 2000,
            "MeterConstant": 1,
            "Consumed": 250
        },
        "EnergyExcess": {
            "Timetables": "Timetables",
            "PreviousReading": 1000,
            "ActualReading": 2000,
            "MeterConstant": 1,
            "Consumed": 250
        }
    }
}
```

## The Extractors List 📌
| Title   | Namespace                                               | Region                     |
|---------|---------------------------------------------------------|----------------------------|
| **RGE** | `NystronSolar\ElectricBillExtractor\BR\RS\ExtractorRGE` | 🇧🇷 ***Brazil*** / ***RS*** |

## RGE
This extractor uses the New Bill from RGE.
Note that just the **New Bill** (RGE starts sending the new bills approximately in 2022 May) is **Implemented** for extraction. The extractor for older version is still being developed.
![image](https://user-images.githubusercontent.com/71853418/227672247-267dc576-401e-41ee-a1bd-d3c05adda7bb.png)
> Image from RGE Website - [Nova Conta | RGE](https://www.rge-rs.com.br/nova-conta) - Access in 03/24/2023 (May, 24th, 2023)
