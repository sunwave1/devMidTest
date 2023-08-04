local _bank = {
	__VERSION = "bank version v02-08-23"
}

_bank.__index = _bank;
  
function bank(iniCapital, time, interestRate)
	local bank = {}

	interestRate = interestRate or 0.0025

	bank.capital = iniCapital
	bank.interestRate = interestRate
	bank.investmentTime = time

	setmetatable(bank, _bank)

	return bank
end
  
function _bank:getCapital()
	return self.capital
end
  
function _bank:setInterestRate(r)
	self.interestRate = r
end
  
function _bank:calculate()
	local finalValue = self.capital * ((1 + self.interestRate) ^ self.investmentTime)
	return finalValue
end
  
io.write("Which your bank [CDB = 1, LCI = 2 or LCA = 3]?: ")
local typeInvestiment = tonumber( io.read() )

io.write("Which your initial capital?: ")
local initialCapital = tonumber( io.read() )

io.write("How much time do you want to invest?: ")
local investmentTime = tonumber( io.read() )

local _bank = bank(initialCapital, investmentTime)

if typeInvestiment == 1 then

	print(
		("At the end of the investment you will have R$ %d using the method CDB."):format( _bank:calculate() )
	)

elseif typeInvestiment == 2 then

	_bank:setInterestRate(0.0035)

	print(
		("At the end of the investment you will have R$ %d using the method LCI."):format( _bank:calculate() )
	)

elseif typeInvestiment == 3 then

	_bank:setInterestRate(0.0055)

	print(
		("At the end of the investment you will have R$ %d using the method LCA."):format( _bank:calculate() )
	)
else

	print("No match your type investiment...")

end
  