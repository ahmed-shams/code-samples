function getValues(Id)
{
	var Values = new Array();
	if(Id == "Gender")
	{
		Values[0] = "Male";
		Values[1] = "Female";
	}
	else if(Id == "status")
	{
		Values[0] = "Single";
		Values[1] = "Married";
		Values[2] = "Divoced";
		Values[3] = "Widowed";
		Values[4] = "Separated";
		Values[5] = "Annulled";
	}/*
	else if(Id == "religion")
	{
		Values[0] = "Agnostic";
		Values[1] = "Atheist";
		Values[2] = "Buddhism";
		Values[3] = "Cao Dai";
		Values[4] = "Chinese";
		Values[5] = "Christianity";
		Values[6] = "Islam";
		Values[7] = "Jainism";
		Values[8] = "Juche";
		Values[9] = "Judaism";
		Values[10] = "Neo-Paganism";
		Values[11] = "Primal-Indigenous";
		Values[12] = "Rastafarianism";
		Values[13] = "Scientology";
		Values[14] = "Secular";
		Values[15] = "Nonreligious";
		Values[16] = "Shinto";
		Values[17] = "Sikhism";
		Values[18] = "Spiritism";
		Values[19] = "Tenrikyo";
		Values[20] = "Zoroastrianism";
	}
	*/
	else if(Id == "religion")
	{
		Values[0] = "Adventist";
		Values[1] = "Agnostic";
		Values[2] = "Atheist";
		Values[3] = "Baptist";
		Values[4] = "Buddhist";
		Values[5] = "Caodaism";
		Values[6] = "Catholic";
		Values[7] = "Christian";
		Values[8] = "Hindu";
		Values[9] = "Iskcon";
		Values[10] = "Jainism";
		Values[11] = "Jewish";
		Values[12] = "Methodist";
		Values[13] = "Mormon";
		Values[14] = "Moslem";
		Values[15] = "Orthodox";
		Values[16] = "Pentecostal";
		Values[17] = "Protestant";
		Values[18] = "Quaker";
		Values[19] = "Scientology";
		Values[20] = "Shinto";
		Values[21] = "Sikhism";
		Values[22] = "Spiritual";
		Values[23] = "Taoism";
		Values[24] = "Wiccan";
		Values[25] = "Other";
	}
	else if(Id == "zodiacsign")
	{
		Values[0] = "Aries";
		Values[1] = "Taurus";
		Values[2] = "Gemini";
		Values[3] = "Cancer";
		Values[4] = "Leo";
		Values[5] = "Virgo";
		Values[6] = "Libra";
		Values[7] = "Scorpio";
		Values[8] = "Sagittarius";
		Values[9] = "Capricorn";
		Values[10] = "Aquarius";
		Values[11] = "Pisces";
	}
	else if(Id == "smoke" || Id == "drink")
	{
		Values[0] = "Yes";
		Values[1] = "No";
		Values[2] = "Rarely";
		Values[3] = "Socially";
		Values[4] = "Quitting";
	}
	else if(Id == "education")
	{
		Values[0] = "Less than high school";
		Values[1] = "High School";
		Values[2] = "Some college";
		Values[3] = "Trade School";
		Values[4] = "Diploma";
		Values[5] = "Bachelors";
		Values[6] = "Masters";
		Values[7] = "Doctorate";
		Values[8] = "Post Graduate";
	}
	else if(Id == "HereFor")
	{
		Values[0] = "Dating";
		Values[1] = "Friends";
		Values[2] = "Serious Relationships";
		Values[3] = "Networking";
	}
	else if(Id == "Orientation")
	{
		Values[0] = "Straight";
		Values[1] = "Gay";
		Values[2] = "Bi-Sexual";
		Values[3] = "Bi-Curious";
	}
	else if(Id == "BodyType")
	{
		Values[0] = "Slim/Slender";
		Values[1] = "Athletic";
		Values[2] = "Average";
		Values[3] = "Some extra baggage";
		Values[4] = "Heavy";
	}
	else if(Id == "Ethnicity")
	{
		Values[0] = "Asian";
		Values[1] = "Black / African descent";
		Values[2] = "East Indian";
		Values[3] = "Latino / Hispanic";
		Values[4] = "Middle Eastern";
		Values[5] = "Native American";
		Values[6] = "Pacific Islander";
		Values[7] = "White / Caucasian";
		Values[8] = "Other";
	}
	else if(Id == "Children")
	{
		Values[0] = "No";
		Values[1] = "Yes.Living together";
		Values[2] = "Yes.Not living together";
	}
	else if(Id == "Occupation")
	{
		Values[0] = "Not working";
		Values[1] = "Non-mainstream Professional";
		Values[2] = "Accountant";
		Values[3] = "Acting Professional";
		Values[4] = "Actor";
		Values[5] = "Administration Professional";
		Values[6] = "Advertising Professional";
		Values[7] = "Air Hostess";
		Values[8] = "Architect";
		Values[9] = "Artisan";
		Values[10] = "Audiologist";
		Values[11] = "Banker";
		Values[12] = "Beautician";
		Values[13] = "Biologist";
		Values[14] = "Business Person";
		Values[15] = "Civil Engineer";
		Values[16] = "Clerical Official";
		Values[17] = "Commericial Pilot";
		Values[18] = "Computer Professional";
		Values[19] = "Consultant";
		Values[20] = "Contractor";
		Values[21] = "Customer Service Professional";
		Values[22] = "Dentist";
		Values[23] = "Designer";
		Values[24] = "Doctor";
		Values[25] = "Economist";
		Values[26] = "Engineer";
		Values[27] = "Entertainment Professional";
		Values[28] = "Event Manager";
		Values[29] = "Executive";
		Values[30] = "Factory Worker";
		Values[31] = "Fashion Designer";
		Values[32] = "Finance Professional";
		Values[33] = "Flight Attendant";
		Values[34] = "Government Employee";
		Values[35] = "Health Care Professional";
		Values[36] = "Home Maker";
		Values[37] = "Hotel & Restaurant Professional";
		Values[38] = "Human Resources Professional";
		Values[39] = "Interior Designer";
		Values[40] = "Investment Professional";
		Values[41] = "IT / Telecom Professional";
		Values[42] = "Journalist";
		Values[43] = "Lawyer";
		Values[44] = "Legal Professional";
		Values[45] = "Manager";
		Values[46] = "Marketing Professional";
		Values[47] = "Media Professional";
		Values[48] = "Medical Transcriptionist";
		Values[49] = "Merchant Naval Officer";
		Values[50] = "Nurse";
		Values[51] = "Occupational Therapist";
		Values[52] = "Optician";
		Values[53] = "Pharmacist";
		Values[54] = "Physician Assistant";
		Values[55] = "Physicist";
		Values[56] = "Physiotherapist";
		Values[57] = "Pilot";
		Values[58] = "Politician";
		Values[59] = "Professor";
		Values[60] = "Psychologist";
		Values[61] = "Public Relations Professional";
		Values[62] = "Real Estate Professional";
		Values[63] = "Retired Person";
		Values[64] = "Retail Professional";
		Values[65] = "Sales Professional";
		Values[66] = "Scientist";
		Values[67] = "Self-employed Person";
		Values[68] = "Social Worker";
		Values[69] = "Software Consultant";
		Values[70] = "Student";
		Values[71] = "Teacher";
		Values[72] = "Technician";
		Values[73] = "Training Professional";
		Values[74] = "Transportation Professional";
		Values[75] = "Veterinary Doctor";
		Values[76] = "Volunteer";
		Values[77] = "Writer";
		Values[78] = "Zoologist";
	}
	else if(Id == "Height")
	{
		Values[0] = "4' 05''";
		Values[1] = "4' 06''";
		Values[2] = "4' 07''";
		Values[3] = "4' 08''";
		Values[4] = "4' 09''";
		Values[5] = "4' 10''";
		Values[6] = "4' 11''";
		Values[7] = "5' 00''";
		Values[8] = "5' 01''";
		Values[9] = "5' 02''";
		Values[10] = "5' 03''";
		Values[11] = "5' 04''";
		Values[12] = "5' 05''";
		Values[13] = "5' 06''";
		Values[14] = "5' 07''";
		Values[15] = "5' 08''";
		Values[16] = "5' 09''";
		Values[17] = "5' 10''";
		Values[18] = "5' 11''";
		Values[19] = "6' 00''";
		Values[20] = "6' 01''";
		Values[21] = "6' 02''";
		Values[22] = "6' 03''";
		Values[23] = "6' 04''";
		Values[24] = "6' 05''";
		Values[25] = "6' 06''";
		Values[26] = "6' 07''";
		Values[27] = "6' 08''";
		Values[28] = "6' 09''";
		Values[29] = "6' 10''";
		Values[30] = "6' 11''";
		Values[31] = "7' 00''";
	}
	else if(Id == "State")
	{
		Values['AL'] = "Alabama"
		Values['AK'] = "Alaska"
		Values['AB'] = "Alberta"
		Values['AS'] = "American Samoa"
		Values['AZ'] = "Arizona"
		Values['AR'] = "Arkansas"
		Values['AA'] = "Armed Forces Americas"
		Values['AE'] = "Armed Forces Europe"
		Values['AP'] = "Armed Forces Pacific"
		Values['BC'] = "British Columbia"
		Values['CA'] = "California"
		Values['CO'] = "Colorado"
		Values['CT'] = "Connecticut"
		Values['DE'] = "Delaware"
		Values['DC'] = "District of Columbia"
		Values['FL'] = "Florida"
		Values['GA'] = "Georgia"
		Values['GM'] = "Guam"
		Values['HI'] = "Hawaii"
		Values['ID'] = "Idaho"
		Values['IL'] = "Illinois"
		Values['IN'] = "Indiana"
		Values['IA'] = "Iowa"
		Values['KS'] = "Kansas"
		Values['KY'] = "Kentucky"
		Values['LA'] = "Louisiana"
		Values['ME'] = "Maine"
		Values['MB'] = "Manitoba"
		Values['MD'] = "Maryland"
		Values['MA'] = "Massachusetts"
		Values['MI'] = "Michigan"
		Values['MN'] = "Minnesota"
		Values['MS'] = "Mississippi"
		Values['MO'] = "Missouri"
		Values['MT'] = "Montana"
		Values['NE'] = "Nebraska"
		Values['NV'] = "Nevada"
		Values['NB'] = "New Brunswick"
		Values['NH'] = "New Hampshire"
		Values['NJ'] = "New Jersey"
		Values['NM'] = "New Mexico"
		Values['NY'] = "New York"
		Values['NF'] = "Newfoundland"
		Values['NC'] = "North Carolina"
		Values['ND'] = "North Dakota"
		Values['MP'] = "Northern Marianas Islands"
		Values['NT'] = "Northwest Territories"
		Values['NS'] = "Nova Scotia"
		Values['OH'] = "Ohio"
		Values['OK'] = "Oklahoma"
		Values['ON'] = "Ontario"
		Values['OR'] = "Oregon"
		Values['PW'] = "Palau"
		Values['PA'] = "Pennsylvania"
		Values['PE'] = "Prince Edward Island"
		Values['PQ'] = "Province du Quebec"
		Values['PR'] = "Puerto Rico"
		Values['RI'] = "Rhode Island"
		Values['SK'] = "Saskatchewan"
		Values['SC'] = "South Carolina"
		Values['SD'] = "South Dakota"
		Values['TN'] = "Tennessee"
		Values['TX'] = "Texas"
		Values['UT'] = "Utah"
		Values['VT'] = "Vermont"
		Values['VI'] = "Virgin Islands"
		Values['VA'] = "Virginia"
		Values['WA'] = "Washington"
		Values['DC'] = "Washington, D.C."
		Values['WV'] = "West Virginia"
		Values['WI'] = "Wisconsin"
		Values['WY'] = "Wyoming"
		Values['YT'] = "Yukon Territory" 
	}
	else if(Id == "BandGenre")
	{
		Values[0] = "Alternative";
		Values[1] = "Blues";
		Values[2] = "Children";
		Values[3] = "Classical";
		Values[4] = "Comedy";
		Values[5] = "Country";
		Values[6] = "Dance";
		Values[7] = "Easy Listening";
		Values[8] = "Electronica";
		Values[9] = "Folk";
		Values[10] = "Holiday";
		Values[11] = "Jazz";
		Values[12] = "Latin";
		Values[13] = "Metal";
		Values[14] = "New Age";
		Values[15] = "Oldies";
		Values[16] = "Other";
		Values[17] = "Pop";
		Values[18] = "Rap and Hip-Hop";
		Values[19] = "Reggae";
		Values[20] = "Religious";
		Values[21] = "Rock";
		Values[22] = "Soul and R & B";
		Values[23] = "Soundtracks";
		Values[24] = "Spoken";
		Values[25] = "Vocal";
		Values[26] = "World";	
	}

	else if(Id == "BandLabel")
	{
		Values[0] = "Unsigned";
		Values[1] = "Major";
		Values[2] = "Indie";
	}
	
	else
	{
		Values[0] = "Art";
		Values[1] = "Auto";
		Values[2] = "Blogging";
		Values[3] = "Books";
		Values[4] = "Business";
		Values[5] = "Cities";
		Values[6] = "Education";
		Values[7] = "Food";
		Values[8] = "Friends & Family";
		Values[9] = "Games";
		Values[10] = "Hacks";
		Values[11] = "Help";
		Values[12] = "How-To";
		Values[13] = "IM";
		Values[14] = "Law";
		Values[15] = "Mac";
		Values[16] = "Machinery";
		Values[17] = "Management";
		Values[18] = "Math";
		Values[19] = "Me";
		Values[20] = "Movies";
		Values[21] = "Music";
		Values[22] = "Networks";
		Values[23] = "Online";
		Values[24] = "Other";
		Values[25] = "Parenting";
		Values[26] = "Philosphy";
		Values[27] = "Photos";
		Values[28] = "Politics";
		Values[29] = "Printing";
		Values[30] = "Programming";
		Values[31] = "Quotes";
		Values[32] = "Religion";
		Values[33] = "Reviews";
		Values[34] = "Science";
		Values[35] = "Search";
		Values[36] = "Security";
		Values[37] = "Space";
		Values[38] = "Sports";
		Values[39] = "TV";
		Values[40] = "Toys";
		Values[41] = "Web";
		Values[42] = "Windows";
		Values[43] = "Work";
		Values[43] = "YouGetIt";
	}
	
	return Values;
}