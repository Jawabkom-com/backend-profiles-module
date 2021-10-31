<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSearcher;
use Jawabkom\Standard\Contract\IFilterComposite;

class TestSearcherWithOneResult implements IProfileSearcher
{

    public function search(IFilterComposite $filters): mixed
    {
        return json_decode(<<<JSON
{
  "@http_status_code": 200,
  "@visible_sources": 0,
  "@available_sources": 17,
  "@persons_count": 3,
  "@search_id": "2110130935412215931317484045838397217",
  "query": {
    "phones": [
      {
        "country_code": 962,
        "number": 788208263,
        "display": "07 8820 8263",
        "display_international": "+962 7 8820 8263"
      }
    ]
  },
  "available_data": {
    "premium": {
      "relationships": 2,
      "usernames": 2,
      "jobs": 13,
      "addresses": 5,
      "phones": 3,
      "mobile_phones": 3,
      "educations": 1,
      "languages": 2,
      "user_ids": 5,
      "social_profiles": 7,
      "names": 5,
      "images": 1,
      "genders": 2
    }
  },
  "possible_persons": [
    {
      "@match": 0.6,
      "@search_pointer": "fb8150eaef683d1876de9c65d26f75365bc6afc815e3dec70adf5b7e3edbbb1d5d57812dbb6592363618a1185c13a6eb6343e2502c0261dbcd7d49fdf747d1c72b3effb86da5f712aa11fcc187b1ffea6da79882d71ca5a16e5254c685e0d5cddb0ff0bca73381e942e400d78dcf57e2c71e14e25654a71568476c6348cf987724f6ac70dca3e5a27b86378f963a28d680b1d5a0ee7d04b722930a056e8c45ac7f517e7fb47c3bedb98c7023e39f72ab43c8d3fccfea3f783efc1be783562f32c4f9c1d34653171b0ede70a75c68dab6f0813d4842360f7f00315a3d213d15a9cc0df939001640793ad3a8dda9f46afe4fb2f5025ccadde95ee93e4bff636ef9f2b956da7900d8d5fecba708d3cea9140c82cd5822d31938d0258c341586bba6cb6c93317bd64b3f764f865048c76780972d7eb78f386cd02b6841c3c5734a4fad53fd66ed1a4bb538f36fc87029b0a7d6ab70938e4efce0f774cfd527a67224043f836d68c6ca7b8e80e59ac3155069cec6bb30c594e4fd7bac63d3d757ab5d9631ebff6a28b25da2d74db2daa3861a1de886ece4173a3913d33ed301b04e8458f82bb7982d4b54e30c6db7684bd167747988504b2f4cdce75e89f4811a37d8cb376163c728089f66cb56824387d979a4b138c4604a2f54a735ddf4f296d23f2c4893be2acda4703a4c7ab177cc96b822276c90d49b6c1c6a7acab38fa566366a7eb0a4a3c12998fa8d91b651f52eedb58a254f58fa00746ecdd950880c165ac5b53a2a2369b80365e01af1d6046987762461b48ff047ac53eb13f94a93adb129c7fa638f07580026b0777b5f841924d167e908a5ae3d847e8094843ff66a15763a932abbb75aca6e893eaceb0e393eaf3a6b938d665bf2d5005bf9915a67cf1cba37d5a6d537862a113ef01ebdb7a93a722c1f39b91e46a5dc84a10c4ec295dd7077fcf7429e0279ea8b63e37040826897556c299814027d23e6ae66cbb26c7f4ce34a8e57ffd84fb08a1b263f7d8642870d09033a1259da4f0a5e3e98c396ee7c8585fafe7ea510a88ff402811114aa1afe48f44042619622cbbf8d805ddff58d9cc7ccb4cd53a62f98a38d8156d4e91ab1364deda4177b22448d1a3702f4b7941ce56e0ea087f62131ded4f55353ab92b7a27308bd929bf57a0e7ac609a8c719490dc90bb6fdeed5c734edab0dfd4a316e1eac1a0e7444daff923076fb353cbd06b6bc751bcfa3f69cfd57be87863c087af6272c86e8fc636a46cc9446f48a4c921d9e0bb639238ae9b2f61891920a36f48247265a9e32010a8f6558519214ddee6ad643b930a0805a2b3346c670e1128fa39a7dcd58c87d90d6984f71616d77f8a06eb437ad32f2a335749f554c5c9a3f3e79a4357584396d4c4b490c1be5b86d9ed584e5a6245a0f27f6f8eb0e056c125886a02986de198ae696801ef03a731e8d6c02bb53230555a1bc5a5d943c40cfc7fb14b44d5fe789b99f415f6c97d4e6f4ac2f3fc4d162ff89dd49fdd194abef42582b4cc1143889af62843beea6849d3e31a791bb13f3eb835b05022e727fbe70e563103f8fdd8453e1d845e080a59da568f1a6a14462577dd3faad9fd4d02dd7e5a5cd7f099317daaa767a02bff856da1468e6f32db475bd29d384528b74aa1b542955407d0b44fabbc494d771a5e921a96fe7db444b5d5d523f4507d8a297dade5ee21a6f667d2f11d27d3f46bf60fd95fd13608fe323c21503fe986105834efd82c0aa1695d6dc513213580d1e7c0c1e91387a8304e700e7010690f6cc174d52b574e6e462a2dcb7d5a010fa5618652850ca05be8a861b6a42b16504cef00a2af0c79b74d23bfcbe9b816a756265d6561580da980f8c872292e6b5f6e32deecdb4c3d96f5c58224f420bfd6a7d2591d480397ad44517128151f881a25566e6900f2cabce4dad5a3dc6d7da5396524ad728abb90e2a8f6cb59bef2efcb537f81ba647949faf05264cb5f0fdf67895bc87abe67a78a90940cd4249b5b379db3ce9a873b5e6c59c79b0bbcc8fe3ead2a89334ce08f3c51f52c72c2773a1d78ac0ea03d79c74bc34f7b3debe0fc2187394fc11445cefe980449ff69adf99240bb2e53e71ee029a042fbb305b3f31e81cfff42cddd5e7170fc45f60045708a8e6425974a22409613aeecc5c0fa083ee7714b509ccfa945b212fe2c8de3c2077d02da70b1615cc5e6b3382611bda4d67cef68cde0056e8eeacf9fc949333852011e2ce9d539ac6d6151d0f5bb639f16366738346ad776b448884a9d4e8527c162e90eefb8435766d8784e0a35f288bc07b9f4f6fa7cc2f8c47c1078f025a5ba065b16ba569365ed31361d4bb69b71b16635197b051a0992aea6829fc32de17cce3e33eb81bbfc85e9cd96d96a7dda8de0551843dfb7a10aaa550903184c7000f9fcb30f8bb0c303bc9091b38817d57434c6800e13bb8e8c66df7cb04988c3c785e7c12dd468829f23235b9a7a66e29a9150dc8e5be75335a626e19c05b630ee35fde651174f2a707540d37071141f847b50faf378782a5aa27d47838406a6d448a2be730c75e1be2d35271040075ed5c18d760b36a6370e463d193b340b98582b1036aadfc803222b45f02d8534c31831cc5442a7ec7501b97636f09d1a842f087a6da0b72e7f6eb48d89476872c82afe92e95288f9b7f44118e0be0a8f4e7e189ad1ce7e90cb10fd6a475dfc8d4eba9afc30b6c3b14604964f51e1fe19d76c3f45eedbfe891ff0af6fb51caffd0fe5201f23078188ee79024331e7d564723c13dbed66b8f133937860a812dbb452287dcd406b950d14561213b202f712e1003e8c559662d719dc7e808adc690d8a68906a95831f8349f656fac2c2794af4822b1a3e8ebee3b261134c656a0cf630dddb1c77f807dd9799e1b4e31b2b53d44cd4c8c096cd4a2f91c6c908d87bf6bd48662479ad10c86a76686cef95f3d747b197861e463ecfdac05ff1b6acaeb75a935d77c70e8040c018a90809637a9625972274a0bd9af5d41d8b8cadf16483e2773f275a131fdf8302ad95ef57412a2c653ec21fecda670c3b7ef14666c613bc04641f96d2cd5ec9b3b719c14e19db2014252c2ed77748bf80be391259e71212026522019719a7df99e1bf461bee1fcc69b9e4834bd7c47317dd232ce70728cf7d6320592a63c497a6bf6354477a9c3cf46c72d75648b31475685afaf68848a18ca7f94f575e66059c5e9707d95132e202c79315166dc99818ebe254348420979c843744128ea0e9bc03f4c0c8c1aa880fff4b6a17bafed22385bb7f5d5931e168c0fcb2a66708b94834b2ae3ba866ea4befd1a906da31d5626599723f3b5541eaf0b7dd79f135d728dce61d9a3d6135636f3dccde91ba9d0ad5a7b3a40cf1eea66e16622981202343eb0ea2030a50609fc0d72dd8ce5ff1db61e99ab3ae07496d250b7608152d75a2d12bb05a45a5aa3dea360b576f0d9c05413f993c15044016a5abf0eedd850a5f47d522a402fe0a774efd0c0642cb1241b7b65d81ef36e166bb655713498a5ad7f54fba27261db55c8efb24a1ca86764f4f272218e25b0f38932ead372fd2bd58f6a1c2af0fe2403c26ccc00382d45ea56950e8de95827f7c77285cf602c40c35bd8f025d08d0319a23c3c730fa3c21e7fe70d1e91e748",
      "names": [
        {
          "@valid_since": "2013-01-13",
          "@last_seen": "2021-03-25",
          "first": "Ahmad",
          "middle": "Fathi",
          "last": "Saleh",
          "display": "Ahmad Fathi Saleh"
        }
      ],
      "usernames": [
        {
          "@valid_since": "2010-10-24",
          "@last_seen": "2021-01-06",
          "content": "ahmadfds"
        }
      ],
      "phones": [
        {
          "@valid_since": "2014-05-19",
          "@last_seen": "2021-03-07",
          "@type": "mobile",
          "country_code": 962,
          "number": 788208263,
          "display": "07 8820 8263",
          "display_international": "+962 7 8820 8263"
        }
      ],
      "gender": {
        "@valid_since": "2010-10-24",
        "content": "male"
      },
      "languages": [
        {
          "region": "US",
          "language": "en",
          "display": "en_US"
        }
      ],
      "addresses": [
        {
          "@valid_since": "2013-01-17",
          "@last_seen": "2021-03-25",
          "country": "JO",
          "city": "Jerash",
          "display": "Jerash, Jordan"
        },
        {
          "@valid_since": "2014-05-19",
          "@last_seen": "2021-03-25",
          "@type": "work",
          "country": "JO",
          "city": "Amman",
          "street": "Jordan",
          "display": "Jordan, Amman, Jordan"
        },
        {
          "@valid_since": "2019-10-08",
          "@last_seen": "2021-03-25",
          "country": "TR",
          "display": "Turkey"
        }
      ],
      "jobs": [
        {
          "@valid_since": "2020-02-27",
          "@last_seen": "2021-03-25",
          "title": "Web Development Team Lead",
          "organization": "Jawabkom",
          "date_range": {
            "start": "2017-10-01"
          },
          "display": "Web Development Team Lead at Jawabkom (since 2017)"
        },
        {
          "@valid_since": "2019-10-08",
          "@last_seen": "2021-01-06",
          "title": "Web Development Team Lead",
          "organization": "JawabSale.com",
          "date_range": {
            "start": "2017-10-01"
          },
          "display": "Web Development Team Lead at JawabSale.com (since 2017)"
        },
        {
          "@valid_since": "2016-05-07",
          "@last_seen": "2021-03-25",
          "title": "Senior DevOps Engineer",
          "organization": "Souq.com",
          "date_range": {
            "start": "2016-02-01",
            "end": "2017-10-01"
          },
          "display": "Senior DevOps Engineer at Souq.com (2016-2017)"
        },
        {
          "@valid_since": "2015-09-21",
          "@last_seen": "2021-03-25",
          "title": "Senior Software Engineer",
          "organization": "Souq.com",
          "date_range": {
            "start": "2014-09-01",
            "end": "2016-02-01"
          },
          "display": "Senior Software Engineer at Souq.com (2014-2016)"
        },
        {
          "@valid_since": "2013-01-13",
          "title": "System Architect",
          "organization": "WabLab (Self-employed), System Architect at MiNeeds.com",
          "industry": "Computer Software",
          "date_range": {
            "start": "2011-07-01",
            "end": "2014-09-01"
          },
          "display": "System Architect at WabLab (Self-employed), System Architect at MiNeeds.com (2011-2014)"
        },
        {
          "@valid_since": "2019-04-24",
          "@last_seen": "2021-03-25",
          "title": "Founder",
          "organization": "WabLab",
          "date_range": {
            "start": "2010-09-01",
            "end": "2014-09-01"
          },
          "display": "Founder at WabLab (2010-2014)"
        },
        {
          "@valid_since": "2019-04-24",
          "@last_seen": "2021-03-25",
          "title": "PHP Developer",
          "organization": "Indemaj Technology",
          "date_range": {
            "start": "2008-03-01",
            "end": "2011-02-01"
          },
          "display": "PHP Developer at Indemaj Technology (2008-2011)"
        },
        {
          "@valid_since": "2019-04-24",
          "@last_seen": "2020-06-16",
          "title": "Senior PHP Developer",
          "organization": "MiNeeds.com",
          "date_range": {
            "start": "2008-03-01",
            "end": "2014-02-01"
          },
          "display": "Senior PHP Developer at MiNeeds.com (2008-2014)"
        },
        {
          "@valid_since": "2014-01-01",
          "@last_seen": "2021-01-06",
          "title": "Technical Team Leader",
          "organization": "Indemaj",
          "date_range": {
            "start": "2008-03-01",
            "end": "2011-02-01"
          },
          "display": "Technical Team Leader at Indemaj (2008-2011)"
        },
        {
          "@valid_since": "2014-01-01",
          "@last_seen": "2021-01-06",
          "title": "System Architect",
          "organization": "MiNeeds.com",
          "date_range": {
            "start": "2008-03-01",
            "end": "2014-02-01"
          },
          "display": "System Architect at MiNeeds.com (2008-2014)"
        },
        {
          "@valid_since": "2014-01-01",
          "@last_seen": "2019-10-08",
          "title": "Web Developer",
          "organization": "AlBawaba",
          "date_range": {
            "start": "2007-01-01",
            "end": "2008-12-31"
          },
          "display": "Web Developer at AlBawaba (2007-2008)"
        },
        {
          "@valid_since": "2017-06-26",
          "@last_seen": "2021-03-25",
          "title": "Web Developer",
          "organization": "Al Bawaba News",
          "date_range": {
            "start": "2006-12-01",
            "end": "2008-12-31"
          },
          "display": "Web Developer at Al Bawaba News (2006-2008)"
        },
        {
          "@valid_since": "2021-02-28",
          "@last_seen": "2021-03-25",
          "title": "Sun-microsystems Lab Supervisor",
          "organization": "Philadelphia University",
          "date_range": {
            "start": "2005-04-01",
            "end": "2006-12-01"
          },
          "display": "Sun-microsystems Lab Supervisor at Philadelphia University (2005-2006)"
        }
      ],
      "educations": [
        {
          "@valid_since": "2013-11-28",
          "@last_seen": "2021-03-25",
          "degree": "Bachelor's degree, Computer Science",
          "school": "Philadelphia University - Jordan",
          "date_range": {
            "start": "2001-01-01",
            "end": "2005-12-31"
          },
          "display": "Bachelor's degree, Computer Science from Philadelphia University - Jordan (2001-2005)"
        }
      ],
      "relationships": [
        {
          "@valid_since": "2010-06-02",
          "@type": "other",
          "names": [
            {
              "@valid_since": "2010-06-02",
              "first": "Hani",
              "last": "AlHaliq",
              "display": "Hani Alhaliq"
            }
          ]
        },
        {
          "@valid_since": "2009-07-16",
          "@type": "other",
          "names": [
            {
              "@valid_since": "2009-07-16",
              "first": "Mohannad",
              "last": "Haikal",
              "display": "Mohannad Haikal"
            }
          ]
        }
      ],
      "user_ids": [
        {
          "@valid_since": "2010-07-14",
          "@last_seen": "2019-12-09",
          "content": "549742817@facebook"
        },
        {
          "@valid_since": "2013-01-13",
          "@last_seen": "2021-03-25",
          "content": "46967024@linkedin"
        },
        {
          "@valid_since": "2013-01-13",
          "@last_seen": "2021-03-25",
          "content": "13/88b/ba8@linkedin"
        },
        {
          "@valid_since": "2013-01-13",
          "@last_seen": "2021-03-25",
          "content": "#ba888b13@linkedin"
        }
      ],
      "images": [
        {
          "@valid_since": "2016-01-18",
          "url": "https://s-media-cache-ak0.pinimg.com/avatars/ahmadfds_1346617248_140.jpg",
          "thumbnail_token": "AE2861B20B7D6E22CA814E9059348AAB9C99E565D51CA7AE27F1CCF2813454AE0530DAD8D9DCAD302ACB85625B7C8A49381755E6AD62C64997CF271D571A15619A98C4301FBB30ED4110A5B2C3BAA5E6ECC7EF"
        }
      ]
    }
    
  ]
}
JSON
            , true
        );
    }

    public function getDailyRequestsLimit(): int
    {
        return 0;
    }

    public function getHourlyRequestsLimit(): int
    {
        return 0;
    }

    public function getWeeklyRequestsLimit(): int
    {
        return 0;
    }

    public function getMonthlyRequestsLimit(): int
    {
        return 0;
    }
}
