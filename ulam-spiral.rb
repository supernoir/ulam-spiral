# ULAM SPIRAL
# 0.0.1

require 'prime'
require 'paint'

i = 1
n = "\u25AA".encode('utf-8')

for i in 1..104729 do
 if Prime.prime?(i) == true
    print Paint[n,"#f00"]
    else
    print Paint[n,"#fff"]
 end
end


