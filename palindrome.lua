local pl = {
	_VERSION = 'Palindrome v01-08-2023',
	_GIT = 'sunwave1'
}

pl.__index = pl

function palindrome(word)
	local obj = {}
	
	obj.word = word
	obj.cWord = word --## [ Copy word ] ##--
	
	setmetatable(obj, pl)

	return obj
end

function pl:isPalindrome()
    return self.word == self:toLower():reverse():getCWord()   
end

function pl:toLower()
	
	self.cWord = self.word:lower(self.word:gsub('%s+', ''))
	
	return self
end

function pl:reverse()
    
	self.cWord = self.cWord:reverse()
	
	return self
end

function pl:getCWord()
	return self.cWord
end

function pl:getWord()
	return self.word
end

io.write("Insert a word for validate if is a palindrome: ")
local userWord = io.read()

local meta = palindrome( userWord )

print(
	("This word(%s) is %s palindrome"):format( userWord, meta:isPalindrome() )
)